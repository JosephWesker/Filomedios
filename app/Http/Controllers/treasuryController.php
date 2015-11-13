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
use App\fil_payment_date;
use App\fil_service_order;

class treasuryController extends Controller{
  public function postReadPayments(){
    $payments = fil_payment_date::orderBy('pda_date','asc')->get();
    $outstanding = [];
    $full = [];
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));
    foreach ($payments as $value) {
      if (($today <= date('Y-m-d', strtotime($value->paymentScheme->serviceOrder->ser_end_date))) && ($value->paymentScheme->serviceOrder->ser_auth_admin == 2) && ($value->paymentScheme->serviceOrder->ser_auth_production == 2) && ($value->paymentScheme->serviceOrder->ser_auth_sales == 2)) {
        if ($value->pda_status == 'pendiente') {
          $paymentsTotal = 0;
          foreach ($value->realPayments as $payment) {
            $paymentsTotal = $paymentsTotal + (float) $payment->rpa_amount;
          }          
          if ($paymentsTotal != 0) {            
            $value->pda_outstanding = $paymentsTotal;
          }else{
            $value->pda_outstanding = $value->pda_amount;
          }
          $outstanding[] = $value;
        }else{
          $full[] = $value;
        }
      }
      
    }
    $response = Response::json(array(
      'success' => true,
      'outstanding'   => $outstanding,
      'full'   => $full,
      ));
    return $response;
  }

  public function postReadServiceOrder(){
    $serviceOrder = fil_service_order::orderBy('ser_id','desc')->get();
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));
    $activeServiceOrder = [];
    $historyServiceOrder = [];
    foreach ($serviceOrder as $value) {
      $value->customer;
      if(($today <= date('Y-m-d', strtotime($value->ser_end_date))) && ($value->ser_auth_admin == 2) && ($value->ser_auth_production == 2)&& ($value->ser_auth_sales == 2)){
        $activeServiceOrder[] = $value;
      }else{
        $historyServiceOrder[] = $value;
      }
    }
    $response = Response::json(array(
      'success' => true,
      'activeServiceOrder'   => $activeServiceOrder,
      'historyServiceOrder'   => $historyServiceOrder
      ));
    return $response;
  }

  public function readPayments($id){
    $payments = fil_service_order::find($id)->paymentScheme->paymentDates;
    $outstanding = [];
    $full = [];
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));
    foreach ($payments as $value) {
      if (($today <= date('Y-m-d', strtotime($value->paymentScheme->serviceOrder->ser_end_date))) && ($value->paymentScheme->serviceOrder->ser_auth_admin == 2) && ($value->paymentScheme->serviceOrder->ser_auth_production == 2) && ($value->paymentScheme->serviceOrder->ser_auth_sales == 2)) {
        if ($value->pda_status == 'pendiente') {
          $paymentsTotal = 0;
          foreach ($value->realPayments as $payment) {
            $paymentsTotal = $paymentsTotal + (float) $payment->rpa_amount;
          }          
          if ($paymentsTotal != 0) {            
            $value->pda_outstanding = $paymentsTotal;
          }else{
            $value->pda_outstanding = $value->pda_amount;
          }
          $outstanding[] = $value;
        }else{
          $full[] = $value;
        }
      }
      
    }
    $data  = array('outstanding' => json_encode($outstanding), 'full' => json_encode($full), 'header' => $id);
    return view('tesoreria_orden_de_servicio', $data);
  }

  public function detailPayment($id){
    $payment = fil_payment_date::find($id);
    $serviceOrder = $payment->paymentScheme->serviceOrder;
    $hasIVA = false;
    if ($serviceOrder->ser_iva != 0) {
      $hasIVA = true;
    }
    $fiscal = $serviceOrder->customer->taxData;
    $clienteColum1 = '<b>RFC: </b>'.$fiscal->tax_rfc.
    '<br><b>Razón Social: </b>'.$fiscal->tax_business_name.
    '<br><b>Calle: </b>'.$fiscal->tax_street.
    '<br><b>Número Exterior: </b>'.$fiscal->tax_outdoor_number.
    '<br><b>Número Interior: </b>'.$fiscal->tax_apartment_number.
    '<br><b>Colonia: </b>'.$fiscal->tax_colony.
    '<br><b>Código Postal: </b>'.$fiscal->tax_postal_code;
    $clienteColum2 = '<br><b>Municipio: </b>'.$fiscal->tax_town.
    '<br><b>Localidad: </b>'.$fiscal->tax_locality.
    '<br><b>Estado: </b>'.$fiscal->tax_state.
    '<br><b>País: </b>'.$fiscal->tax_country.
    '<br><b>Email Fiscal: </b>'.$fiscal->tax_tax_email.
    '<br><b>Representante Legal: </b>'.$fiscal->tax_legal_representative;
    $data = array(
      'clienteColum1' => $clienteColum1, 
      'clienteColum2' => $clienteColum2, 
      'pda_id' => $id, 
      'ser_id' => $serviceOrder->ser_id,
      'hasIVA' => $hasIVA
      );
    return view('tesoreria_realPayment', $data);
  }
}
