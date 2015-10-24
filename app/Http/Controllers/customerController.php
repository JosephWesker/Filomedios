<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use App\fil_customer;
use App\fil_tax_data;
use App\fil_postal_codes;

class customerController extends Controller{
  public function postCreate(){
    $values = Request::all();
    $values["customer"]['cus_fk_employee'] = Session::get('id');
    $values["customer"]['cus_status'] = 'prospecto';
    fil_customer::create($values["customer"]);
    $lastRow = fil_customer::orderBy('cus_id', 'desc')->first();
    $values["tax_data"]['tax_fk_customer'] = $lastRow->cus_id;
    fil_tax_data::create($values["tax_data"]);
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Cliente guardado con exito'
      ));
    return $response;
  }

  public function postRead(){
    $values = Request::all();
    $dataCustomer = fil_customer::find($values['id']);
    $dataTaxData =  $dataCustomer->taxData;
    $dataAddressData = fil_postal_codes::find($dataTaxData->tax_postal_code);
    $response = Response::json(array(
      'success' => true,
      'dataCustomer'   => $dataCustomer,
      'dataTaxData' => $dataTaxData,
      'dataAddressData' => $dataAddressData
      ));
    return $response; 
  }

  public function postUpdate(){
    $values = Request::all();
    $dataCustomer = fil_customer::find($values['id']);
    $dataCustomer->cus_commercial_name = $values['customer']['cus_commercial_name'];
    $dataCustomer->cus_contact_first_name = $values['customer']['cus_contact_first_name'];
    $dataCustomer->cus_contact_last_name = $values['customer']['cus_contact_last_name'];
    $dataCustomer->cus_job = $values['customer']['cus_job'];
    $dataCustomer->cus_phone_number = $values['customer']['cus_phone_number'];
    $dataCustomer->cus_cellphone_number = $values['customer']['cus_cellphone_number'];
    $dataCustomer->cus_email = $values['customer']['cus_email'];
    $dataCustomer->cus_address = $values['customer']['cus_address'];
    $dataCustomer->cus_business_activity = $values['customer']['cus_business_activity'];
    $dataCustomer->save();

    $dataTaxData = $dataCustomer->taxData;
    $dataTaxData->tax_rfc = $values['tax_data']['tax_rfc'];
    $dataTaxData->tax_business_name = $values['tax_data']['tax_business_name'];
    $dataTaxData->tax_street = $values['tax_data']['tax_street'];
    $dataTaxData->tax_outdoor_number = $values['tax_data']['tax_outdoor_number'];
    $dataTaxData->tax_apartment_number = $values['tax_data']['tax_apartment_number'];
    $dataTaxData->tax_colony = $values['tax_data']['tax_colony'];
    $dataTaxData->tax_postal_code = $values['tax_data']['tax_postal_code'];
    $dataTaxData->tax_town = $values['tax_data']['tax_town'];
    $dataTaxData->tax_locality = $values['tax_data']['tax_locality'];
    $dataTaxData->tax_state = $values['tax_data']['tax_state'];
    $dataTaxData->tax_country = $values['tax_data']['tax_country'];
    $dataTaxData->tax_tax_email = $values['tax_data']['tax_tax_email'];
    $dataTaxData->tax_legal_representative = $values['tax_data']['tax_legal_representative'];
    $dataTaxData->save();

    $response = Response::json(array(
      'success' => true,
      'data'   => 'Cliente actualizado con exito'
      ));
    return $response;
  }

  public function postDelete(){
    $values = Request::all();
    $data = fil_customer::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Cliente eliminado exitosamente'
      ));
    return $response;
  }

  public function postReadAll(){
    $dataCustomer = fil_customer::all();
    $finalArray = [];
    foreach ($dataCustomer as $value) {
      $tempRow['cus_id'] = $value->cus_id;
      $tempRow['cus_name'] = $value->cus_contact_first_name.' '.$value->cus_contact_last_name;
      $tempRow['cus_enterprise'] = 'Nombre Comercial: '.$value->cus_commercial_name.'<br>Actividad o Giro: '.$value->cus_business_activity;
      $tempRow['cus_contact'] = 'Puesto: '.$value->cus_job.'<br>Teléfono Fijo: '.$value->cus_phone_number.'<br>Teléfono Celular: '.$value->cus_cellphone_number.'<br>Correo: '.$value->cus_email.'<br>Dirección: '.$value->cus_address;
      $finalArray[] = $tempRow;
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
    return $response; 
  }

  public function postReadPostalCodes(){
    $data = fil_postal_codes::select('pos_postal_code')->orderBy('pos_postal_code','asc')->get();
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postReadAddressData(){
    $id = Request::input('id');
    $data = fil_postal_codes::find($id);        
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postReadFiscalData(){
    $id = Request::input('id');
    $customer = fil_customer::find($id);
    $fiscal = $customer->taxData;
    $modalTitle = "Datos fiscales del Cliente: ".$customer->cus_commercial_name;
    $modalBody = '<b>RFC: </b>'.$fiscal->tax_rfc.
    '<br><b>Razón Social: </b>'.$fiscal->tax_business_name.
    '<br><b>Calle: </b>'.$fiscal->tax_street.
    '<br><b>Número Exterior: </b>'.$fiscal->tax_outdoor_number.
    '<br><b>Número Interior: </b>'.$fiscal->tax_apartment_number.
    '<br><b>Colonia: </b>'.$fiscal->tax_colony.
    '<br><b>Código Postal: </b>'.$fiscal->tax_postal_code.
    '<br><b>Municipio: </b>'.$fiscal->tax_town.
    '<br><b>Localidad: </b>'.$fiscal->tax_locality.
    '<br><b>Estado: </b>'.$fiscal->tax_state.
    '<br><b>País: </b>'.$fiscal->tax_country.
    '<br><b>Email Fiscal: </b>'.$fiscal->tax_tax_email.
    '<br><b>Representante Legal: </b>'.$fiscal->tax_legal_representative;
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
}
