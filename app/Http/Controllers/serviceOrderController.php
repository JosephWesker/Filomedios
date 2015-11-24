<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
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
use App\fil_product_fil_service_order;

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
    foreach ($products as $value) {
      switch ($value->pro_type) {
        case 'Spot':
        $productType = $value->spot;
      break;
      case 'Web':
        $productType = $value->web;
      break;
      case 'Programa':
        $productType = $value->show;
      break;
      case 'Producción':
        $productType = $value->production;
      break;
      }
    }
    return $response = Response::json(array(
      'success' => true,
      'data'   => $products
      ));
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
    $serviceOrder->ser_outlay = $values['ser_outlay_total'];
    $serviceOrder->ser_iva = $values['ser_iva'];
    $serviceOrder->ser_duration = $values['ser_duration'];
    $serviceOrder->ser_start_date = $values['ser_start_date'];
    $serviceOrder->ser_end_date = $values['ser_end_date'];
    $serviceOrder->ser_cus_id = $values['ser_fk_customer'];
    $serviceOrder->ser_auth_admin = 0;
    $serviceOrder->ser_auth_production = 0;
    $serviceOrder->ser_auth_sales = 0;
    $serviceOrder->ser_observations_production = '';
    $serviceOrder->ser_observations_admin = '';
    $serviceOrder->ser_observations_sales = '';
    $serviceOrder->save();
       
    $this->createDetails($serviceOrder,json_decode(json_encode($values['detail_product'])));
    if ($values['needProductionRegistry']) {
      $this->createProductionRegistry($serviceOrder,json_decode(json_encode($values['productionRegistry'])));
    }
    $this->createPayments($serviceOrder,$values['pay_number_payments'],$values['payment_date']);    
  }

  function createDetails($serviceOrder,$details){
    foreach ($details as $value) {
      $detail = new fil_product_fil_service_order;
      $detail->pso_ser_id = $serviceOrder->ser_id;
      $detail->pso_pro_id = $value->det_fk_product; 
      $detail->pso_amount = $value->det_amount;
      $detail->pso_subtotal = $value->det_final_price;
      $detail->save();
    }
  }

  function createProductionRegistry($serviceOrder,$values){
    $detailProduction = new fil_detail_production;
    $detailProduction->dpr_ser_id = $serviceOrder->ser_id;
    $detailProduction->dpr_recording_date = $values->dpr_recording_date;
    $detailProduction->dpr_proposal_1_date = $values->dpr_proposal_1_date;
    $detailProduction->dpr_proposal_2_date = $values->dpr_proposal_2_date;
    $detailProduction->dpr_status = "Pendiente";
    $detailProduction->save();
  }


  function createPayments($serviceOrder,$numberPayments,$payments){
    for ($i=0; $i < $numberPayments; $i++) { 
      $paymentDate = new fil_payment_date;
      $paymentDate->pda_ser_id = $serviceOrder->ser_id;
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

  public function anyReadServiceOrderSeller(){
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

  }
}