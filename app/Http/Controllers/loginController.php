<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller;
use App\fil_employee;

class loginController extends Controller{
  public function postLogon(){
    $values = Request::all();
    $employee = fil_employee::where('emp_email',$values['email'])->first();
    if($employee!=null){
      if(Hash::check($values['password'], $employee->emp_password)){
        Session::put('id',$employee->emp_id);
        Session::put('user',$employee->emp_first_name.' '.$employee->emp_last_name);
        Session::put('type',$employee->emp_job);
        Session::put('logged', true);
        $success = true;        
        $data = 'Bienvenido '.Session::get('user');;         
      }else{
        $success = false;
        $data = 'Contraseña incorrecta';    
      }
    }else{
      $success = false;
      $data = 'el usuario no existe';      
    }    
    $response = Response::json(array(
        'success' => $success,
        'data'   => $data
        ));
      return $response;
  }

  public function getLogoff(){
    Session::flush();
    return Redirect::to('login');
  }
}
