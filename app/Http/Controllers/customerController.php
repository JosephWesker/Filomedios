<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use App\fil_customer;
use App\fil_tax_data;
use App\fil_postal_codes;
use App\fil_employee;

class customerController extends Controller
{
    public function postCreate() {
        $values = Request::all();
        if ($values['customer']["cus_contact_first_name"] == '' || $values['customer']["cus_contact_first_name"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Nombre de la persona de contacto requerido'));
        }
        if ($values['customer']["cus_contact_last_name"] == '' || $values['customer']["cus_contact_last_name"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo apellido de la persona de contacto requerido'));
        }
        if ($values['customer']["cus_job"] == '' || $values['customer']["cus_job"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo puesto requerido'));
        }
        if ($values['customer']["cus_cellphone_number"] == '' || $values['customer']["cus_cellphone_number"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Celular requerido'));
        }
        if ($values['customer']["cus_address"] == '' || $values['customer']["cus_address"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo dirección requerido'));
        }
        $values["customer"]['cus_fk_employee'] = Session::get('id');
        $values["customer"]['cus_status'] = 'prospecto';
        fil_customer::create($values["customer"]);
        $lastRow = fil_customer::orderBy('cus_id', 'desc')->first();
        $values["tax_data"]['tax_fk_customer'] = $lastRow->cus_id;
        fil_tax_data::create($values["tax_data"]);
        $response = Response::json(array('success' => true, 'data' => 'Cliente guardado con exito'));
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $dataCustomer = fil_customer::find($values['id']);
        $dataTaxData = $dataCustomer->taxData;
        $dataAddressData = fil_postal_codes::find($dataTaxData->tax_postal_code);
        $response = null;
        if ($dataCustomer == null || $dataTaxData == null || $dataAddressData == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los datos'));
        } 
        else {
            $response = Response::json(array('success' => true, 'dataCustomer' => $dataCustomer, 'dataTaxData' => $dataTaxData, 'dataAddressData' => $dataAddressData));
        }
        return $response;
    }
    
    public function postUpdate() {
        $values = Request::all();
        if ($values['customer']["cus_contact_first_name"] == '' || $values['customer']["cus_contact_first_name"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Nombre de la persona de contacto requerido'));
        }
        if ($values['customer']["cus_contact_last_name"] == '' || $values['customer']["cus_contact_last_name"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo apellido de la persona de contacto requerido'));
        }
        if ($values['customer']["cus_job"] == '' || $values['customer']["cus_job"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo puesto requerido'));
        }
        if ($values['customer']["cus_cellphone_number"] == '' || $values['customer']["cus_cellphone_number"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Celular requerido'));
        }
        if ($values['customer']["cus_address"] == '' || $values['customer']["cus_address"] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo dirección requerido'));
        }
        $response = null;
        $dataCustomer = fil_customer::find($values['id']);
        if ($dataCustomer == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el cliente a actualizar'));
        }
        $dataCustomer->cus_commercial_name = $values['customer']['cus_commercial_name'];
        $dataCustomer->cus_contact_first_name = $values['customer']['cus_contact_first_name'];
        $dataCustomer->cus_contact_last_name = $values['customer']['cus_contact_last_name'];
        $dataCustomer->cus_job = $values['customer']['cus_job'];
        $dataCustomer->cus_phone_number = $values['customer']['cus_phone_number'];
        $dataCustomer->cus_cellphone_number = $values['customer']['cus_cellphone_number'];
        $dataCustomer->cus_email = $values['customer']['cus_email'];
        $dataCustomer->cus_address = $values['customer']['cus_address'];
        $dataCustomer->cus_business_activity = $values['customer']['cus_business_activity'];
        if ($dataCustomer->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Cliente actualizado con exito'));
        } 
        else {
            return Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar el cliente'));
        }
        
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
        if ($dataTaxData->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Cliente actualizado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar el cliente'));
        }
        return $response;
    }
    
    public function postDelete() {
        $values = Request::all();
        $data = fil_customer::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el cliente a eliminar'));
        }
        foreach ($data->ServiceOrders as $serviceOrder) {
            $serviceOrder->ser_auth_production = 3;
            $serviceOrder->ser_auth_admin = 3;
            $serviceOrder->ser_auth_sales = 3;
            $serviceOrder->ser_observations_production = '';
            $serviceOrder->ser_observations_admin = '';
            $serviceOrder->ser_observations_sales = '';
            $serviceOrder->save();
        }
        $data->cus_status = 'eliminado';
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Cliente eliminado exitosamente'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar al cliente'));
        }
        return $response;
    }

    public function postActivate() {
        $values = Request::all();
        $data = fil_customer::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el cliente a restaurar'));
        }       
        $data->cus_status = 'prospecto';
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Cliente restaurado exitosamente'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al restaurar al cliente'));
        }
        return $response;
    }
    
    public function postReadAll() {
        $dataCustomer = null;
        if (Session::get('type') == 'vendedor') {
            $dataCustomer = fil_customer::where('cus_fk_employee', '=', Session::get('id'))->where('cus_status', 'not like', 'eliminado')->get();
        } 
        else {
            $dataCustomer = fil_customer::where('cus_status', 'not like', 'eliminado')->get();
        }
        $finalArray = [];
        foreach ($dataCustomer as $value) {
            $tempRow['cus_id'] = $value->cus_id;
            $tempRow['cus_name'] = $value->cus_contact_first_name . ' ' . $value->cus_contact_last_name;
            $tempRow['cus_enterprise'] = 'Nombre Comercial: ' . $value->cus_commercial_name . '<br>Actividad o Giro: ' . $value->cus_business_activity;
            $tempRow['cus_contact'] = 'Puesto: ' . $value->cus_job . '<br>Teléfono Fijo: ' . $value->cus_phone_number . '<br>Teléfono Celular: ' . $value->cus_cellphone_number . '<br>Correo: ' . $value->cus_email . '<br>Dirección: ' . $value->cus_address;
            $tempRow['cus_status'] = $value->cus_status;
            $finalArray[] = $tempRow;
        }
        $response = null;
        if ($dataCustomer == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los datos de los clientes'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $finalArray));
        }
        return $response;
    }
    
    public function postReadAllDelete() {
        $dataCustomer = fil_customer::where('cus_status', 'like', 'eliminado')->get();
        $finalArray = [];
        foreach ($dataCustomer as $value) {
            $tempRow['cus_id'] = $value->cus_id;
            $tempRow['cus_name'] = $value->cus_contact_first_name . ' ' . $value->cus_contact_last_name;
            $tempRow['cus_enterprise'] = 'Nombre Comercial: ' . $value->cus_commercial_name . '<br>Actividad o Giro: ' . $value->cus_business_activity;
            $tempRow['cus_contact'] = 'Puesto: ' . $value->cus_job . '<br>Teléfono Fijo: ' . $value->cus_phone_number . '<br>Teléfono Celular: ' . $value->cus_cellphone_number . '<br>Correo: ' . $value->cus_email . '<br>Dirección: ' . $value->cus_address;
            $tempRow['cus_status'] = $value->cus_status;
            $finalArray[] = $tempRow;
        }
        $response = null;
        if ($dataCustomer == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los datos de los clientes'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $finalArray));
        }
        return $response;
    }

    public function postReadPostalCodes() {
        $data = fil_postal_codes::select('pos_postal_code')->orderBy('pos_postal_code', 'asc')->get();
        $response = null;
        if ($data == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los códigos postales'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $data));
        }
        return $response;
    }
    
    public function postReadAddressData() {
        $id = Request::input('id');
        $data = fil_postal_codes::find($id);
        $response = null;
        if ($data == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los datos postales'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $data));
        }
        return $response;
    }
    
    public function postReadFiscalData() {
        $id = Request::input('id');
        $customer = fil_customer::find($id);
        if ($customer == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los datos fiscales'));
        }
        $fiscal = $customer->taxData;
        $modalTitle = "Datos fiscales del Cliente: " . $customer->cus_commercial_name;
        $modalBody = '<b>RFC: </b>' . $fiscal->tax_rfc . '<br><b>Razón Social: </b>' . $fiscal->tax_business_name . '<br><b>Calle: </b>' . $fiscal->tax_street . '<br><b>Número Exterior: </b>' . $fiscal->tax_outdoor_number . '<br><b>Número Interior: </b>' . $fiscal->tax_apartment_number . '<br><b>Colonia: </b>' . $fiscal->tax_colony . '<br><b>Código Postal: </b>' . $fiscal->tax_postal_code . '<br><b>Municipio: </b>' . $fiscal->tax_town . '<br><b>Localidad: </b>' . $fiscal->tax_locality . '<br><b>Estado: </b>' . $fiscal->tax_state . '<br><b>País: </b>' . $fiscal->tax_country . '<br><b>Email Fiscal: </b>' . $fiscal->tax_tax_email . '<br><b>Representante Legal: </b>' . $fiscal->tax_legal_representative;
        $data = array('title' => $modalTitle, 'body' => $modalBody);
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
    
    public function postGetByEmployee() {
        $id = Request::input('id');
        $data = fil_employee::find($id)->customers;
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer clientes'));
        } 
        else {
            $finalArray = [];
            foreach ($data as $value) {
                $tempRow['cus_id'] = $value->cus_id;
                $tempRow['cus_name'] = $value->cus_contact_first_name . ' ' . $value->cus_contact_last_name;
                $tempRow['cus_enterprise'] = 'Nombre Comercial: ' . $value->cus_commercial_name . '<br>Actividad o Giro: ' . $value->cus_business_activity;
                $tempRow['cus_contact'] = 'Puesto: ' . $value->cus_job . '<br>Teléfono Fijo: ' . $value->cus_phone_number . '<br>Teléfono Celular: ' . $value->cus_cellphone_number . '<br>Correo: ' . $value->cus_email . '<br>Dirección: ' . $value->cus_address;                
                $finalArray[] = $tempRow;
            }
            return Response::json(array('success' => true, 'data' => $finalArray));
        }
    }

    public function postChangeEmployee(){
        $values = Request::all();
        foreach ($values['customers'] as $value) {
            $customer = fil_customer::find($value);
            $customer->cus_fk_employee = $values['id'];
            $customer->save();
        };
        return Response::json(array('success' => true, 'data' => 'Clientes actualizados con exíto'));
    } 
}
