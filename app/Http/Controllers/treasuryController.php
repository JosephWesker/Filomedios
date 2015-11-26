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
use App\fil_invoice;
use App\fil_real_payment;

class treasuryController extends Controller{
  public function postReadPayments(){
    $payments = fil_payment_date::orderBy('pda_date','asc')->get();
    $outstanding = [];
    $full = [];
    $late = [];
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));
    foreach ($payments as $value) {
      $value->serviceOrder->customer;
      if (($value->serviceOrder->ser_auth_admin == 2) && ($value->serviceOrder->ser_auth_production == 2) && ($value->serviceOrder->ser_auth_sales == 2)) {
        if ($value->pda_status == 'facturado') {          
          $paymentsTotal = 0;
          /*foreach ($value->realPayments as $payment) {
            $paymentsTotal = $paymentsTotal + (float) $payment->rpa_amount;
          }*/                    
          //$value->pda_outstanding = ((float) $value->pda_amount) - $paymentsTotal ;
          if (($today <= date('Y-m-d', strtotime($value->pda_date)))) {
            $outstanding[] = $value;
          }else{
            $late[] = $value;
          }          
        }else{
          if ($value->pda_status == 'pagado') {
            $full[] = $value;
          } 
        }
      }
      
    }
    $response = Response::json(array(
      'success' => true,
      'outstanding'   => $outstanding,
      'full'   => $full,
      'late' => $late,
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
      if (($value->ser_auth_admin == 2) && ($value->ser_auth_production == 2)&& ($value->ser_auth_sales == 2)) {
        if(($today <= date('Y-m-d', strtotime($value->ser_end_date)))){
          $activeServiceOrder[] = $value;
        }else{
          $historyServiceOrder[] = $value;
        }
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
    $payments = fil_service_order::find($id)->paymentsDate;
    $outstanding = [];
    $full = [];
    $late = [];
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));
    foreach ($payments as $value) {
      if (($value->serviceOrder->ser_auth_admin == 2) && ($value->serviceOrder->ser_auth_production == 2) && ($value->serviceOrder->ser_auth_sales == 2)) {
        if ($value->pda_status == 'facturado') {
          $paymentsTotal = 0;
          /*foreach ($value->realPayments as $payment) {
            $paymentsTotal = $paymentsTotal + (float) $payment->rpa_amount;
          }*/   
          $value->serviceOrder->customer;       
          //$value->pda_outstanding = ((float) $value->pda_amount) - $paymentsTotal;
          if (($today <= date('Y-m-d', strtotime($value->pda_date)))) {
            $outstanding[] = $value;
          }else{
            $late[] = $value;
          }    
        }else{
          if ($value->pda_status == 'pagado') {
            $full[] = $value;
          }          
        }
      }      
    }
    $customer = fil_service_order::find($id)->customer->cus_contact_first_name.' '.fil_service_order::find($id)->customer->cus_contact_last_name;
    $commercialName = fil_service_order::find($id)->customer->cus_commercial_name;
    $data  = array('outstanding' => json_encode($outstanding), 'full' => json_encode($full), 'late' => json_encode($late), 'header' => $id, 'customer' => $customer, 'commercialName' => $commercialName);
    return view('tesoreria_orden_de_servicio', $data);
  }

  public function detailPayment($id){
    $payment = fil_payment_date::find($id);
    $serviceOrder = fil_payment_date::find($id)->serviceOrder;
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
      'ser_id' => $serviceOrder->ser_id,
      'hasIVA' => $hasIVA,
      'payment' => json_encode($payment)
      );
    return view('tesoreria_realPayment', $data);
  }

  public function postReadCFDIS(){
    $invoices = fil_invoice_data::all();
    $response = Response::json(array(
      'success' => true,
      'data' => $invoices
      ));
    return $response;
  }

  public function postCreateRealPayment(){
    $values = Request::all();
    $payment = fil_payment_date::find($values['rpa_fk_payment_date']);
    $payment->pda_real_date = date('Y-m-d');
    if ($values['rpa_method'] == 'contado') {
      $payment->pda_method = $values['rpa_method'];
      $payment->pda_account = '';
    }else{
      $payment->pda_method = $values['rpa_method'];
      $payment->pda_account = $values['rpa_account'];
    }
    $payment->pda_status = 'pagado';
    $payment->save();

    //$this->checkForStatus($values['rpa_fk_payment_date']);

    $response = Response::json(array(
      'success' => true,
      'data' => 'Pago guardado con exito'
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

  function convertToBolean($value){
    if($value=='true'){
      return true;
    }else{
      return false;
    } 
  }

  function checkForStatus($id){
    $value = fil_payment_date::find($id);
    $paymentsTotal = 0;
    foreach ($value->realPayments as $payment) {
      $paymentsTotal = $paymentsTotal + (float) $payment->rpa_amount;
    }
    if ($paymentsTotal == $value->pda_amount) {
      $value->pda_status = 'pagado';
      $value->save();
    }          
  }

  public function postReadPaymentsToInvoice(){
    $payments = fil_payment_date::orderBy('pda_date','asc')->get();
    $invoice = [];
    $recipt = [];
    foreach ($payments as $value) {
      if (($value->serviceOrder->ser_auth_admin == 2) && ($value->serviceOrder->ser_auth_production == 2) && ($value->serviceOrder->ser_auth_sales == 2)) {
        if ($value->pda_status == 'pendiente') {                    
          $value->serviceOrder->customer;
          if ($value->serviceOrder->ser_iva == 0) {
            $recipt[] = $value;
          }else{
            $invoice[] = $value;
          }          
        }
      }
    }
    $response = Response::json(array(
      'success' => true,
      'invoice'   => $invoice,
      'recipt'   => $recipt
      ));
    return $response;
  }

  public function postSaveInvoice(){
    $payment = fil_payment_date::find(Request::get('id'));
    $invoice = new fil_invoice;
    $invoice->inv_pda_id = $payment->pda_id;
    $invoice->inv_cfdi = Request::get('content');
    $invoice->save();
    $payment->pda_status = 'facturado';
    $payment->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Factura guardada con exito'
      ));
    return $response;
  }

}
