<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_customer;
use App\fil_product;
use App\fil_business_unit;
use App\fil_show;
use App\fil_package;
use App\fil_id_helper;
use App\fil_service_order;
use App\fil_detail_production;
use App\fil_payment_scheme;
use App\fil_detail_product;
use App\fil_transmission_scheme;
use App\fil_payment_date;

class serviceOrderController extends Controller{

  public function postReadCustomers(){
    $finalArray = [];
    $customers = fil_customer::all();
    foreach ($customers as $value) {
      $row['cus_id'] = $value->cus_id;
      $row['cus_commercial_name'] = $value->cus_commercial_name;
      $row['cus_contact'] = $value->cus_contact_first_name.' '.$value->cus_contact_last_name;
      $row['tax_business_name'] = $value->taxData->tax_business_name;
      $row['tax_rfc'] = $value->taxData->tax_rfc;
      $finalArray[] = $row;
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
    return $response;
  }

  public function postLoadProductsData(){
    $products = fil_product::all();
    $finalArray = [];
    foreach ($products as $value) {
      $row['pro_id'] = $value->pro_id;
      $row['pro_name'] = $value->pro_name;
      $row['pro_type'] = $value->pro_type;
      if($value->pro_type == 'transmisión'){
        $row['pro_extra'] = $value->serviceProyection;
      }else{
        $row['pro_extra'] = $value->serviceProduction;
      }
      $finalArray[] = $row;
    }
    return $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
  }

  public function postLoadSelects(){
    $shows = fil_show::all(['sho_id','sho_name']);
    $businessUnits = fil_business_unit::all(['bus_id','bus_name']);
    return $response = Response::json(array(
      'success' => true,
      'show' => $shows,
      'businessUnit' => $businessUnits
    ));
  }

  public function postLoadPackages(){
    $response = Response::json(array(
      'success' => true,
      'data'   => fil_package::all(['pac_id','pac_name'])
      ));
    return $response;
  }

  public function postLoadPackagesDetail(){
    $values = Request::all();
    $package = fil_package::find($values['id']);
    $detail = $package->packagesDetail;
    $finalArray = [];
    foreach ($detail as $value) {
      $row = [];
      $row['det_fk_product'] = $value->product->pro_id;
      $row['det_name'] = $value->product->pro_name;
      $row['det_fk_business_unit'] = null;

      if($value->product->serviceProyection->spy_has_show){
        $row['det_fk_show'] = null;
      };

      if($value->product->serviceProyection->spy_has_transmission_scheme == 1){
        $row['det_has_transmission_scheme'] = null;
      };

      $row['det_impacts'] = $value->pad_impacts;
      $row['det_validity'] = $value->pad_validity;
      $row['det_discount'] = $value->pad_discount;      
      $row['det_final_price'] = $value->pad_final_price; 

      if (($value->product->serviceProyection->spy_proyection_media == 'televisión') and ($value->product->serviceProyection->spy_has_show == "0")) {
        $row['det_subtotal'] = (float) $row['det_final_price'] * (float) $row['det_validity'] * (float) $row['det_impacts'] * 10;
      }else{
        $row['det_subtotal'] = (float) $row['det_final_price'] * (float) $row['det_validity'] * (float) $row['det_impacts'];
      }

      $finalArray[] = $row;
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
    return $response;
  }

  public function createServiceOrderId(){
    $idHelper = fil_id_helper::find(1);
    $year = date("Y");    

    if($idHelper->idh_year != $year){
      $idHelper->idh_year = $year;
      $idHelper->idh_number = 1;
      $idHelper->save();
    }

    $idNumber = $idHelper->idh_number;
    $number = "";

    switch(strlen((string)$idNumber)){
      case 1:
      $number = '000'.$idHelper->idh_number;
      break;
      case 2:
      $number = '00'.$idHelper->idh_number;
      break;    
      case 3:
      $number = '0'.$idHelper->idh_number;
      break;
      case 4:
      $number = $idHelper->idh_number;
      break;
    }    

    $idHelper->idh_number = ($idNumber+1);
    $idHelper->save();

    return ($number."/".$year);
  }

  public function postCreateOrder(){
    $values = Request::all();
    $serviceOrder = new fil_service_order;
    $serviceOrder->ser_id = $this->createServiceOrderId();
    $serviceOrder->ser_discount_month = $values['ser_discount_month'];
    $serviceOrder->ser_outlay_total = $values['ser_outlay_total'];
    $serviceOrder->ser_iva = $values['ser_iva'];
    $serviceOrder->ser_duration = $values['ser_duration'];
    $serviceOrder->ser_start_date = $values['ser_start_date'];
    $serviceOrder->ser_end_date = $values['ser_end_date'];
    $serviceOrder->ser_fk_customer = $values['ser_fk_customer'];
    $serviceOrder->ser_auth_admin = 0;
    $serviceOrder->ser_auth_production = 0;
    $serviceOrder->ser_auth_sales = 0;

    $serviceOrder->save();
       
    $this->createDetails($serviceOrder,json_decode(json_encode($values['detail_product'])));
    $this->createPayments($serviceOrder,$values['pay_amount_cash'],$values['pay_amount_kind'],$values['pay_number_payments'],$values['payment_date']);    
  }

  function createDetails($serviceOrder,$details){
    foreach ($details as $value) {
      $detail = new fil_detail_product;
      $detail->det_fk_product = $value->det_fk_product;

      if(property_exists($value, 'det_fk_business_unit')){
        $detail->det_fk_business_unit = $value->det_fk_business_unit;  
      }else{
        $detail->det_fk_business_unit = null;
      }
      
      if(property_exists($value, 'det_fk_show')){
        $detail->det_fk_show = $value->det_fk_show;  
      }else{
        $detail->det_fk_show = null;
      }

      $detail->det_fk_service_order = $serviceOrder->ser_id;
      $detail->det_impacts = $value->det_impacts;
      $detail->det_validity = $value->det_validity;
      $detail->det_discount = $value->det_discount;
      $detail->det_final_price = $value->det_final_price;

      $detail->save();


      if(property_exists($value, 'det_has_production_registry')){
        $this->createProductionRegistry($detail,$value->det_has_production_registry);  
      }

      if(property_exists($value, 'det_has_transmission_scheme')){
          $this->createTransmissionScheme($detail,$value->det_has_transmission_scheme);
      }

    }
  }

  function createProductionRegistry($detail,$values){
    $detailProduction = new fil_detail_production;
    $detailProduction->dpr_id = $detail->det_id;
    $detailProduction->dpr_recording_date = $values->dpr_recording_date;
    $detailProduction->dpr_proposal_1_date = $values->dpr_proposal_1_date;
    $detailProduction->dpr_proposal_2_date = $values->dpr_proposal_2_date;
    $detailProduction->dpr_status = "Pendiente";
    $detailProduction->save();
  }

  function createTransmissionScheme($detail,$values){
    $transmissionScheme = new fil_transmission_scheme;
    $transmissionScheme->tra_id = $detail->det_id;
    $transmissionScheme->tra_monday = $this->convertToTinyint($values->tra_monday);
    $transmissionScheme->tra_tuesday = $this->convertToTinyint($values->tra_tuesday);
    $transmissionScheme->tra_wednesday = $this->convertToTinyint($values->tra_wednesday);
    $transmissionScheme->tra_thursday = $this->convertToTinyint($values->tra_thursday);
    $transmissionScheme->tra_friday = $this->convertToTinyint($values->tra_friday);
    $transmissionScheme->tra_saturday = $this->convertToTinyint($values->tra_saturday);
    $transmissionScheme->tra_sunday = $this->convertToTinyint($values->tra_sunday);
    $transmissionScheme->save();
  }

  function createPayments($serviceOrder,$amountCash,$amountKind,$numberPayments,$payments){
    $paymentScheme = new fil_payment_scheme;
    $paymentScheme->pay_id = $serviceOrder->ser_id;
    $paymentScheme->pay_amount_kind = $amountKind;
    $paymentScheme->pay_amount_cash = $amountCash;
    $paymentScheme->pay_number_payments = $numberPayments;
    $paymentScheme->save();
    for ($i=0; $i < $numberPayments; $i++) { 
      $paymentDate = new fil_payment_date;
      $paymentDate->pda_fk_payment_data = $paymentScheme->pay_id;
      $paymentDate->pda_date = $payments[$i]['pda_date'];
      $paymentDate->pda_amount = $payments[$i]['pda_amount'];
      $paymentDate->pda_status = "pendiente";
      $paymentDate->save();
    }
  }

  function convertToTinyint($value){
    if($value=='true'){
      return 1;
    }else{
      return 0;
    } 
  }
}
