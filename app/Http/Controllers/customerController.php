<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\fm_customer;
use App\fm_tax_data;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class customerController extends Controller
{
    public function postShowCustomers(){
        $fm_customer = DB::table('fm_customer')
                ->leftjoin('fm_tax_data','cus_id','=','tax_fk_customer')
                ->orderby('cus_id','asc')
                ->get();
        return Response::json($fm_customer);
    }
    
    public function postGetCustomer(){
        $id = Request::input('id');
        $fm_customer = fm_customer::find($id);
        return Response::json($fm_customer);
    }

    public function postCreateCustomer(){
        $values = Request::all();
        $fm_customer = new fm_customer;
        $fm_customer->cus_commercial_name = $values['cus_commercial_name'];
        $fm_customer->cus_contact_first_name = $values['cus_contact_first_name'];
        $fm_customer->cus_contact_last_names = $values['cus_contact_last_names'];
        $fm_customer->cus_job = $values['cus_job'];
        $fm_customer->cus_phone_number = $values['cus_phone_number'];
        $fm_customer->cus_cellphone_number = $values['cus_cellphone_number'];
        $fm_customer->cus_email = $values['cus_email'];
        $fm_customer->cus_address = $values['cus_address'];
        $fm_customer->cus_business_name = $values['cus_business_name'];
        $fm_customer->cus_fk_employee = $values['cus_fk_employee'];
        $fm_customer->save();
        
        $fm_tax_data = new fm_tax_data;
        $fm_tax_data->tax_fk_customer = $fm_customer->cus_id;
        $fm_tax_data->tax_rfc = $values['tax_rfc'];
        $fm_tax_data->tax_street = $values['tax_street'];
        $fm_tax_data->tax_outdoor_number = $values['tax_outdoor_number'];
        $fm_tax_data->tax_apartment_number = $values['tax_apartment_number'];
        $fm_tax_data->tax_colony = $values['tax_colony'];
        $fm_tax_data->tax_postal_code = $values['tax_postal_code'];
        $fm_tax_data->tax_town = $values['tax_town'];
        $fm_tax_data->tax_locality = $values['tax_locality'];
        $fm_tax_data->tax_state = $values['tax_state'];
        $fm_tax_data->tax_country = $values['tax_country'];
        $fm_tax_data->tax_tax_email = $values['tax_tax_email'];
        $fm_tax_data->tax_legal_representative = $values['tax_legal_representative'];
        $fm_tax_data->save();
        return 'Cliente registrado, su ID de cliente es ' . $fm_customer->cus_id;
    }

    public function postDelateCustomer(){
        $id = Request::input('id');
        $fm_customer = fm_customer::find($id);
        $fm_customer->delete();
        return 'Cliente eliminado';
    }

    public function postUpdateCustomer(){
        $values = Request::all();
        $fm_customer = fm_customer::find($values['emp_id']);
        $fm_customer->emp_first_name = $values['emp_first_name'];
        $fm_customer->emp_last_names = $values['emp_last_names'];
        $fm_customer->emp_address = $values['emp_address'];
        $fm_customer->emp_phone_number = $values['emp_phone_number'];
        $fm_customer->emp_cellphone_number = $values['emp_cellphone_number'];
        $fm_customer->emp_email = $values['emp_email'];
        $fm_customer->emp_job = $values['emp_job'];
        $fm_customer->save();
        
        return 'Cliente actualizado';
    }

}
