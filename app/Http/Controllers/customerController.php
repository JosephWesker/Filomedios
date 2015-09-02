<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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
    
    public function postShowEmployeesSelect(){
        $fm_employee = \App\fm_employee::select('emp_id','emp_first_name','emp_last_names')
        ->where('emp_job','=','vendedor')
        ->get();
        return Response::json($fm_employee);
    }
    
    public function postGetCustomer(){
        $id = Request::input('id');
        $fm_customer = DB::table('fm_customer')
                        ->where('cus_id','=',$id)
                        ->leftjoin('fm_tax_data','cus_id','=','tax_fk_customer')
                        ->orderby('cus_id','asc')                
                        ->first();
        return Response::json($fm_customer);
    }    

    public function postCreateCustomer(){
        $values = Request::all();
       
//BEGIN COMMERCIAL NAME
$rule_commercialname=array(
 'cus_commercial_name'=>'required',
     );
       $vconame=Validator::make($values,$rule_commercialname);
 if ($vconame->fails())
        {                  
            return 'Complete el campo Nombre Comercial';
        }
      //END COMMERCIAL NAME
        
        //BEGIN CONTACTFIRSTNAME
$rule_contactfirstname=array(
 'cus_contact_first_name'=>'required',
     );
       $vcontactfn=Validator::make($values,$rule_contactfirstname);
 if ($vcontactfn->fails())
        {                  
            return 'Complete el campo Nombre de la persona de contacto';
        }
      //END CONTACTFIRSTNAME
             
             //BEGIN LASTNAMECONTACT
$rule_contactlastname=array(
 'cus_contact_last_names'=>'required',
     );
       $vcontactln=Validator::make($values,$rule_contactlastname);
 if ($vcontactln->fails())
        {                  
            return 'Complete el campo Apellidos de la persona de contacto';
        }
      //END LASTNAMECONTACT
                 //BEGIN TELEPHONE1
$rule_cellphone=array(
 'cus_cellphone_number'=>'numeric|min:6|required',
  'cus_phone_number'=>'numeric|min:6'
     );
       $vcphone=Validator::make($values,$rule_cellphone);
 if ($vcphone->fails())
        {                  
            return 'Complete el campo Celular y/o verifique que sea válido';
        }
   //ENDTELEPHONE1

               //BEGIN EMAIL
$rule_email=array(
 'cus_email'=>'required|email|min:5|Regex:/^[A-Za-z0-9\-! ,"\/@\.:\(\)]+$/',
     );
       $vemail=Validator::make($values,$rule_email);
 if ($vemail->fails())
        {                  
            return 'Complete el campo Email y/o verifique que sea válido';
        }
      //END EMAIL

                    //BEGIN RFC
$rule_rfc=array(
 'tax_rfc'=>'alpha_num',
     );
       $vrfc=Validator::make($values,$rule_rfc);
 if ($vrfc->fails())
        {                  
            return 'RFC no válido';
        }
      //END RFC
       //BEGIN TAX_APARTMENT NUMBER
$rule_tax_apartmentoutdoor=array(
 'tax_apartment_number'=>'numeric',
     );
       $vtaxapartmentdoor=Validator::make($values,$rule_tax_apartmentoutdoor);
 if ($vtaxapartmentdoor->fails())
        {                  
            return 'Número Exterior no válido';
        }
      //END TAX_APARTMENT_APARTMENT NUMBER
                    //BEGIN TAX_OUTDOOR NUMBER
$rule_tax_outdoor=array(
 'tax_outdoor_number'=>'numeric',
     );
       $vtaxoutdoor=Validator::make($values,$rule_tax_outdoor);
 if ($vtaxoutdoor->fails())
        {                  
            return 'Número interior no válido';
        }
      //END TAXOUTDOOR_NUMBER
      //BEGIN TAX_OUTDOOR NUMBER
$rule_tax_outdoor=array(
 'tax_outdoor_number'=>'numeric',
     );
       $vtaxoutdoor=Validator::make($values,$rule_tax_outdoor);
 if ($vtaxoutdoor->fails())
        {                  
            return 'Número interior no válido';
        }
      //END TAXOUTDOOR_NUMBER   
              //BEGIN EMAIL2
$rule_taxemail=array(
 'tax_tax_email'=>'email|min:5|Regex:/^[A-Za-z0-9\-! ,"\/@\.:\(\)]+$/',
     );
       $vtaxemail=Validator::make($values,$rule_taxemail);
 if ($vtaxemail->fails())
        {                  
            return 'Email fiscal no válido';
        }
      //END EMAIL2
        $fm_customer = new fm_customer;
        $fm_customer->cus_commercial_name = $values['cus_commercial_name'];
        $fm_customer->cus_contact_first_name = $values['cus_contact_first_name'];
        $fm_customer->cus_contact_last_names = $values['cus_contact_last_names'];
        $fm_customer->cus_job = $values['cus_job'];
        $fm_customer->cus_phone_number = $values['cus_phone_number'];
        $fm_customer->cus_cellphone_number = $values['cus_cellphone_number'];
        $fm_customer->cus_email = $values['cus_email'];
        $fm_customer->cus_address = $values['cus_address'];        
        $fm_customer->cus_fk_employee = $values['cus_fk_employee'];
        $fm_customer->save();
        
        $fm_tax_data = new fm_tax_data;
        $fm_tax_data->tax_fk_customer = $fm_customer->cus_id;
        $fm_tax_data->tax_business_name = $values['tax_business_name'];
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

    public function postDeleteCustomer(){
        $id = Request::input('id');
        $fm_customer = fm_customer::find($id);
        $fm_customer->delete();
        return 'Cliente eliminado';
    }

    public function postUpdateCustomer(){
        $values = Request::all();
        $fm_customer = fm_customer::find($values['cus_id']);
        $fm_customer->cus_commercial_name = $values['cus_commercial_name'];
        $fm_customer->cus_contact_first_name = $values['cus_contact_first_name'];
        $fm_customer->cus_contact_last_names = $values['cus_contact_last_names'];
        $fm_customer->cus_job = $values['cus_job'];
        $fm_customer->cus_phone_number = $values['cus_phone_number'];
        $fm_customer->cus_cellphone_number = $values['cus_cellphone_number'];
        $fm_customer->cus_email = $values['cus_email'];
        $fm_customer->cus_address = $values['cus_address'];        
        $fm_customer->cus_fk_employee = $values['cus_fk_employee'];
        $fm_customer->save();
        
        $fm_tax_data = fm_tax_data::find($values['cus_id']);
        $fm_tax_data->tax_fk_customer = $fm_customer->cus_id;
        $fm_tax_data->tax_business_name = $values['tax_business_name'];
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
        return 'Cliente actualizado';
    }

}
