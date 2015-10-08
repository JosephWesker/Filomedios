<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_employee;
use App\fil_business_unit;

class employeeController extends Controller{
  public function postCreate(){
    $values = Request::all();
    $values['emp_password'] = hash::make($values['emp_password']);
    fil_employee::create($values);
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Empleado guardado con exito'
      ));
    return $response;
  }

  public function postRead(){
    $values = Request::all();
    $data = fil_employee::select(['emp_first_name','emp_last_name','emp_address','emp_phone_number','emp_cellphone_number','emp_job','emp_fk_business_unit','emp_email'])->find($values['id']);    
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postUpdate(){
    $values = Request::all();
    $data = fil_employee::find($values['id']);
    $data->emp_first_name = $values['emp_first_name'];
    $data->emp_last_name = $values['emp_last_name'];
    $data->emp_address = $values['emp_address'];
    $data->emp_phone_number = $values['emp_phone_number'];
    $data->emp_cellphone_number = $values['emp_cellphone_number'];
    $data->emp_job = $values['emp_job'];
    $data->emp_fk_business_unit = fil_business_unit::find($values['emp_fk_business_unit'])->bus_id;
    $data->emp_email = $values['emp_email'];    
    $data->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Empleado actualizado con exito'
      ));
    return $response;
  }

  public function postDelete(){
    $values = Request::all();
    $data = fil_employee::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Empleado eliminado exitosamente'
      ));
    return $response;
  }

  public function postReadAll(){
    $data = fil_employee::all();
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response;
  }

  public function postLoadBusinessUnit(){    
    $response = Response::json(array(
      'success' => true,
      'data'   => fil_business_unit::all(['bus_id','bus_name'])
      ));
    return $response;
  }
}
