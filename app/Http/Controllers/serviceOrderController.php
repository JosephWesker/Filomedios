<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
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
use App\fil_postal_codes;

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

    return ($number."-".$year);
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
    $serviceOrder->ser_observations_production = '';
    $serviceOrder->ser_observations_admin = '';
    $serviceOrder->ser_observations_sales = '';
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

  function postSavePayments(){
    $values = Request::all();
    $values = json_decode(json_encode($values));
    $serviceOrder = fil_service_order::find($values->serviceOrder);
    $serviceOrder->ser_discount_month = $values->discount;
    $serviceOrder->ser_outlay_total = $values->totalOutlay;
    $serviceOrder->ser_iva = $values->iva;
    $serviceOrder->save();
    $paymentScheme = $serviceOrder->paymentScheme;
    $paymentScheme->pay_amount_kind = $values->amountKind;
    $paymentScheme->pay_amount_cash = $values->amountCash;
    $paymentScheme->pay_number_payments = $values->numberPayments;
    $paymentScheme->save();
    if (property_exists($values,'paymentsold')) {
      foreach ($values->paymentsold as $value) {
        $payment = fil_payment_date::find($value->pda_id);
        $payment->pda_amount = $value->pda_amount;
        $payment->pda_date = $value->pda_date;
        $payment->save();
      }
    }
    if (property_exists($values,'paymentsnew')) {
      foreach ($values->paymentsnew as $value) {
        $paymentDate = new fil_payment_date;
        $paymentDate->pda_fk_payment_data = $paymentScheme->pay_id;
        $paymentDate->pda_date = $value->pda_date;
        $paymentDate->pda_amount = $value->pda_amount;
        $paymentDate->pda_status = "pendiente";
        $paymentDate->save();
      }
    }
    
    $response = Response::json(array(
      'success' => true,
      'data'   => 'pagos guardados correctamente'
      ));
    return $response;
  }

  function convertToTinyint($value){
    if($value=='true'){
      return 1;
    }else{
      return 0;
    } 
  }

  public function postReadServiceOrderSeller(){
    $data = fil_service_order::where('emp_id','like', Session::get('id'))->join('fil_customer', 'ser_fk_customer', '=', 'cus_id')->join('fil_employee', 'cus_fk_employee', '=', 'emp_id')->get();
    $finalArray = [];

    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));

    foreach ($data as $value) {
      $row = [];
      
      $row['ser_id'] = $value->ser_id;
      $row['ser_fk_customer'] = $value->customer->cus_contact_first_name." ".$value->customer->cus_contact_last_name;
      $row['created_at'] = date_format(date_create($value->created_at),'Y-m-d');

      if($today <= date('Y-m-d', strtotime($value->ser_end_date))){
        if ($value->ser_auth_admin == '3') {
          $row['status'] = 'canceled';
        }else{
          if ($value->ser_auth_admin == '2' && $value->ser_auth_production == '2' && $value->ser_auth_sales == '2') {
            $row['status'] = 'accepted';
          }else{ 

            if ($value->ser_auth_admin == '1' || $value->ser_auth_production == '1' || $value->ser_auth_sales == '1') {
              $row['status'] = 'rejected';            
            }else{
              $row['status'] = 'pending';
            }

            $row['detail_status']  = array(
              'admin' => $this->getStatus($value->ser_auth_admin),
              'production' => $this->getStatus($value->ser_auth_production),
              'sales' => $this->getStatus($value->ser_auth_sales),
              );
          }
        }
      }else{
        $row['status'] = 'history'; 
      }

      $finalArray[] = $row;
    }

    $response = Response::json(array(
      'success' => true,
      'data' => $finalArray
      ));
    return $response;

  }

  function getStatus($ser_auth){
    $response = '';
    switch ($ser_auth) {
      case '0':
      $response = 'Pendiente';
      break;
      case '1':
      $response = 'Rechazada';
      break;
      case '2':
      $response = 'Aceptada';
      break;     
    }
    return $response;
  }
  

  public function postReadServiceOrderAuth(){
    $data = fil_service_order::all();
    $rejected = [];
    $pending = [];
    $accepted = [];
    $canceled = []; 
    $history = [];   

    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));

    foreach ($data as $value) {      
      $row = [];
      $row['ser_id'] = $value->ser_id;
      $row['ser_fk_customer'] = $value->customer->cus_contact_first_name." ".$value->customer->cus_contact_last_name;
      $row['created_at'] = date_format(date_create($value->created_at),'Y-m-d');
      if($today <= date('Y-m-d', strtotime($value->ser_end_date))){
        switch (Session::get('type')) {                
          case 'producción':
          switch ($value->ser_auth_production) {
            case '0':                
            $pending[] = $row;
            break;
            case '1':
            $rejected[] = $row;
            break;
            case '2':
            $accepted[] = $row;
            break;
            case '3':
            $canceled[] = $row;
            break;            
          }
          break;
          case 'administrador':
          case 'tesoreria':
          switch ($value->ser_auth_admin) {
            case '0':
            $pending[] = $row;
            break;
            case '1':
            $rejected[] = $row;
            break;
            case '2':
            $accepted[] = $row;
            break;
            case '3':
            $canceled[] = $row;
            break;             
          }
          break;
          case 'gerente de ventas':
          switch ($value->ser_auth_sales) {
            case '0':
            $pending[] = $row;
            break;
            case '1':
            $rejected[] = $row;
            break;
            case '2':
            $accepted[] = $row;
            break;
            case '3':
            $canceled[] = $row;
            break;             
          }
          break;
        }
      }else{
        $history[] = $row;
      }
    }
    $response = Response::json(array(
      'success' => true,
      'rejected' => $rejected,
      'pending' => $pending,
      'accepted' => $accepted,
      'canceled' => $canceled,
      'history' => $history
      ));
    return $response;
  }

  public function postAuthOrder(){
    $values = Request::all();
    $serviceOrder = fil_service_order::find($values['id']);
    switch (Session::get('type')) {
      case 'producción':
      $serviceOrder->ser_auth_production = 2;
      $serviceOrder->ser_observations_production = '';
      break;
      case 'administrador':
      case 'tesoreria':
      $serviceOrder->ser_auth_admin = 2;
      $serviceOrder->ser_observations_admin = '';
      break;
      case 'gerente de ventas':
      $serviceOrder->ser_auth_sales = 2;
      $serviceOrder->ser_observations_sales = '';
      break;
    }
    $serviceOrder->save();
  }

  public function postRejectOrder(){
    $values = Request::all();
    $serviceOrder = fil_service_order::find($values['id']);
    switch (Session::get('type')) {
      case 'producción':
      $serviceOrder->ser_observations_production = $values['comment'];
      $serviceOrder->ser_auth_production = 1;
      break;
      case 'administrador':
      case 'tesoreria':
      $serviceOrder->ser_observations_admin = $values['comment'];
      $serviceOrder->ser_auth_admin = 1;
      break;
      case 'gerente de ventas':
      $serviceOrder->ser_observations_sales = $values['comment'];
      $serviceOrder->ser_auth_sales = 1;
      break;
    }
    $serviceOrder->save();
  }

  public function postCancelOrder(){
    $data = '';
    if(Session::get('type') == "administrador" || Session::get('type') == "tesoreria"){
      $values = Request::all();
      $serviceOrder = fil_service_order::find($values['id']);
      $serviceOrder->ser_auth_production = 3;
      $serviceOrder->ser_auth_admin = 3;
      $serviceOrder->ser_auth_sales = 3;
      $serviceOrder->ser_observations_production = '';
      $serviceOrder->ser_observations_admin = '';
      $serviceOrder->ser_observations_sales = '';
      $serviceOrder->save();
      $data = 'Orden Cancelada';
    }else{
      $data = 'No cuenta con los permisos suficientes para esta acción';
    }

    $response = Response::json(array(
      'success' => true,
      'data' => $data
      ));

    return $response;
  }

  public function showServiceOrder($id){
    $serviceOrder = fil_service_order::find($id);
    $serviceOrder->customer->taxData;
    $serviceOrder->paymentScheme->paymentDates;

    foreach ($serviceOrder->detailsProducts as $value) {
      $value->product->serviceProyection;
      $value->product->serviceProduction;
      $value->detailProduction;
      $value->show;
      $value->businessUnit;
    };

    $generals = true;
    $payments = true;
    $proyection = true;
    $production = true;
    
    if ($serviceOrder->ser_auth_admin != 3) {
      if (Session::get('type') == "administrador" || Session::get('type') == "tesoreria") {
        $generals = false;
        $payments = false;
      }
      if (Session::get('type') == "gerente de ventas") {
        $payments = false;
      }
      if (Session::get('type') == "producción") {
        $proyection = false;
        $production = false;
      }
      if (Session::get('type') == "vendedor") {
        $generals = true;
        $payments = true;
        $proyection = true;
        $production = true;
        if ($serviceOrder->ser_auth_admin == 1) {
          $generals = false;
          $payments = false;
        }
        if ($serviceOrder->ser_auth_sales == 1) {
          $payments = false;
        }
        if ($serviceOrder->ser_auth_production == 1) {
          $proyection = false;
          $production = false;
        }
      }
    }

    $data['editable'] = array(
      'generals' => $generals, 
      'payments' => $payments,
      'proyection' => $proyection,
      'production' => $production
      );

    $data['AddressData'] = fil_postal_codes::find($serviceOrder->customer->taxData->tax_postal_code);
    $data['json'] = json_encode($serviceOrder);
    $data['editable'] = json_encode($data['editable']);
    return view('orden_de_servicio', $data);
  }  

  public function postReadComments(){
    $id = Request::input('id');
    $serviceOrder = fil_service_order::find($id);
    $modalTitle = "Comentarios de la Orden: ".$id;
    $modalBody = '<b>Administración: </b>'.$serviceOrder->ser_observations_admin.
    '<br><b>producción: </b>'.$serviceOrder->ser_observations_production.
    '<br><b>Ventas: </b>'.$serviceOrder->ser_observations_sales;
    $data = array(
      'title'=> $modalTitle,
      'body' => $modalBody
      );
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postDeletePayments(){
    $id = Request::input('id');
    $payment = fil_payment_date::find($id);
    $paymentScheme = $payment->paymentScheme;
    $number = (int) $paymentScheme->pay_number_payments;
    $paymentScheme->pay_number_payments = --$number;
    $paymentScheme->save();
    $payment->delete();
    foreach ($paymentScheme->paymentDates as $value) {
      $value->pda_amount = ((float) $paymentScheme->pay_amount_cash)/$number;
      $value->save();
    }
    
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Pago eliminado'
      ));
    return $response;
  }

  public function postUpdateOrderDuration(){
    $values = Request::all();
    $serviceOrder = fil_service_order::find($values['id']);
    $serviceOrder->ser_duration = $values['ser_duration'];
    $serviceOrder->ser_start_date = $values['ser_start_date'];
    $serviceOrder->ser_end_date = $values['ser_end_date'];
    $serviceOrder->ser_outlay_total = $values['totalOutlay'];
    $serviceOrder->ser_iva = $values['iva'];
    $serviceOrder->save();
    $paymentScheme = $serviceOrder->paymentScheme;
    $paymentScheme->pay_amount_cash = $values['amountCash'];    
    $paymentScheme->save();
    foreach ($paymentScheme->paymentDates as $value) {
      $value->pda_amount = $values['paymentAmount'];
      $value->save();
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => 'fechas guardadas'
      ));
    return $response;
  }

  public function postAddProduct(){
    $values = Request::all();
    $value = json_decode(json_encode($values['row']));
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

    $detail->det_fk_service_order = $values['ser_id'];
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

    $serviceOrder = fil_service_order::find($values['ser_id']);
    $serviceOrder->ser_outlay_total = $values['totalOutlay'];
    $serviceOrder->ser_iva = $values['iva'];
    $serviceOrder->save();

    $paymentScheme = $serviceOrder->paymentScheme;
    $paymentScheme->pay_amount_cash = $values['amountCash'];    
    $paymentScheme->save();
    foreach ($paymentScheme->paymentDates as $payment) {
      $payment->pda_amount = $values['paymentAmount'];
      $payment->save();
    }



    $serviceOrder = fil_service_order::find($values['ser_id']);
    $serviceOrder->customer->taxData;
    $serviceOrder->paymentScheme->paymentDates;
    foreach ($serviceOrder->detailsProducts as $value) {
      $value->product->serviceProyection;
      $value->product->serviceProduction;
      $value->detailProduction;
      $value->show;
      $value->businessUnit;
    };
    $response = Response::json(array(
      'success' => true,
      'data'   => $serviceOrder,
      'adressData' => fil_postal_codes::find($serviceOrder->customer->taxData->tax_postal_code)
      ));
    return $response;
  }

  public function postUploadFiles(){

  }
}
