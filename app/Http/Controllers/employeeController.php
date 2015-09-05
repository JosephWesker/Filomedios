<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\fm_employee;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class employeeController extends Controller
{
  public function postShowEmployees(){
    $query = fm_employee::select('emp_id','emp_first_name','emp_last_names','emp_address','emp_phone_number','emp_cellphone_number','emp_job','use_username')
    ->join('fm_user','emp_fk_user','=','use_id')
    ->get();
    return Response::json($query);
  }
  
  public function postShowUserSelect(){
    $fm_user = \App\fm_user::all(['use_id','use_username']);
    return Response::json($fm_user);
  }
  
  public function postGetEmployee(){
    $id = (int) Request::input('id');       
    $fm_employee = fm_employee::find($id);
    return Response::json($fm_employee);
  }

  public function postCreateEmployee(){
    $values = Request::all();
//BEGIN FIRST NAME
    $rule_fname=array(
     'emp_first_name'=>'required|min:3',
     );
    $vfname=Validator::make($values,$rule_fname);
    if ($vfname->fails())
    {                  
      return 'Complete el campo nombre';
    }
      //END FIRSTNAME
        //BEGIN LAST NAME
    $rule_lname=array(
     'emp_last_names'=>'required|min:3',
     );
    $vlname=Validator::make($values,$rule_lname);
    if ($vlname->fails())
    {                  
      return 'Complete el campo Apellido';
    }
      //END LASTNAME
                //BEGIN ADDRESS
    $rule_address=array(
     'emp_address'=>'required',
     );
    $vaddress=Validator::make($values,$rule_address);
    if ($vaddress->fails())
    {                  
      return 'Complete el campo Dirección';
    }
      //END ADDRESS
    
        //BEGIN PHONE1
    $rule_phone1=array(
     'emp_phone_number'=>'numeric|min:6',
     );
    $vphone1=Validator::make($values,$rule_phone1);
    if ($vphone1->fails())
    {                  
      return 'Teléfono fijo no válido';
    }
      //END PHONE1

        //BEGIN CELLPHONE
    $rule_cellphone=array(
     'emp_cellphone_number'=>'required|min:6',
     );
    $vcphone=Validator::make($values,$rule_cellphone);
    if ($vcphone->fails())
    {                  
      return 'Complete el campo Celular';
    }
      //END CELLPHONE
         //BEGIN CELLPHONE1
    $rule_cellphone1=array(
     'emp_cellphone_number'=>'numeric|min:10',
     );
    $vcphone1=Validator::make($values,$rule_cellphone1);
    if ($vcphone1->fails())
    {                  
      return 'Celular no válido';
    }
      //END CELLPHONE1
     //BEGIN EMP_JOB
    $rule_empjob=array(
     'emp_job'=>'required',
     );
    $vempjob=Validator::make($values,$rule_empjob);
    if ($vempjob->fails())
    {                  
      return 'Complete el campo puesto';
    }
      //END EMP_JOB
             //BEGIN emp_fk_user
    $rule_empfkuser=array(
     'emp_fk_user'=>'required',
     );
    $vempfk=Validator::make($values,$rule_empfkuser);
    if ($vempfk->fails())
    {                  
      return 'Seleccione un usuario';
    }
      //END EMP_FK_USER

    $matchThese = ['emp_first_name' => $values['emp_first_name'], 'emp_last_names' => $values['emp_last_names']];
    $employee = fm_employee::where($matchThese)->count();
    if ($employee > 0) {
      return 'Este empleado ya esta registrado en la base de datos';
    }else{                  
      $fm_employee = new fm_employee([
        'emp_first_name' => $values['emp_first_name'],
        'emp_last_names' => $values['emp_last_names'],
        'emp_address' => $values['emp_address'],
        'emp_phone_number' => $values['emp_phone_number'],
        'emp_cellphone_number' => $values['emp_cellphone_number'],
        'emp_job' => $values['emp_job'],
        'emp_fk_user' => $values['emp_fk_user']
        ]);
      $fm_employee->save();
      return 'Empleado registrado, su ID de empleado es ' . $fm_employee->emp_id;
    }
  }

  public function postDelateEmployee(){
    $id = Request::input('id');
    $fm_employee = fm_employee::find($id);
    $fm_employee->delete();
    return 'Empleado eliminado';
  }

  public function postUpdateEmployee(){
    $values = Request::all();
    $fm_employee = fm_employee::find($values['emp_id']);
    $fm_employee->emp_first_name = $values['emp_first_name'];
    $fm_employee->emp_last_names = $values['emp_last_names'];
    $fm_employee->emp_address = $values['emp_address'];
    $fm_employee->emp_phone_number = $values['emp_phone_number'];
    $fm_employee->emp_cellphone_number = $values['emp_cellphone_number'];
    $fm_employee->emp_job = $values['emp_job'];
    $fm_employee->emp_fk_user = $values['emp_fk_user'];
    $fm_employee->save();
    
    return 'Empleado actualizado';
  }

}
