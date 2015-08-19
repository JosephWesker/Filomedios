<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\fm_employee;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class employeeController extends Controller
{
    public function postShowEmployees(){
        $fm_employee = fm_employee::all();
        return Response::json($fm_employee);
    }
    
    public function postGetEmployee(){
        $id = Request::input('id');
        $fm_employee = fm_employee::find($id);
        return Response::json($fm_employee);
    }

    public function postCreateEmployee(){
        $values = Request::all();
        
        $email = fm_employee::where('emp_email','like', $values['emp_email'])->count();
        if($email>0){
            return 'Este correo ya esta registrado, por favor utilize uno diferente';
        }else {

            $matchThese = ['emp_first_name' => $values['emp_first_name'], 'emp_last_names' => $values['emp_last_names']];
            $employee = fm_employee::where($matchThese)->count();
            if ($employee > 0) {
                return 'Este empleado ya esta registrado en la base de datos';
            }else{

                $username = fm_employee::where('emp_username','like', $values['emp_username'])->count();
                if($username>0){
                    return 'Este usuario ya se encuentra registrado, por favor utilice otro';
                }else {

                    $password_encrypted = Hash::make($values['emp_password']);
                    $fm_employee = new fm_employee;
                    $fm_employee->emp_first_name = $values['emp_first_name'];
                    $fm_employee->emp_last_names = $values['emp_last_names'];
                    $fm_employee->emp_address = $values['emp_address'];
                    $fm_employee->emp_phone_number = $values['emp_phone_number'];
                    $fm_employee->emp_cellphone_number = $values['emp_cellphone_number'];
                    $fm_employee->emp_email = $values['emp_email'];
                    $fm_employee->emp_job = $values['emp_job'];
                    $fm_employee->emp_username = $values['emp_username'];
                    $fm_employee->emp_password = $password_encrypted;
                    $fm_employee->save();
                    return 'Usuario registrado, su id de empleado es ' . $fm_employee->emp_id;
                }
            }
        }
    }

    public function postDelateEmployee(){
        $id = Request::input('id');
        $fm_employee = fm_employee::find($id);
        $fm_employee->delete();
        return 'Usuario eliminado';
    }

    public function postUpdateEmployee(){
        $values = Request::all();
        $fm_employee = fm_employee::find($values['emp_id']);
        $fm_employee->emp_first_name = $values['emp_first_name'];
        $fm_employee->emp_last_names = $values['emp_last_names'];
        $fm_employee->emp_address = $values['emp_address'];
        $fm_employee->emp_phone_number = $values['emp_phone_number'];
        $fm_employee->emp_cellphone_number = $values['emp_cellphone_number'];
        $fm_employee->emp_email = $values['emp_email'];
        $fm_employee->emp_job = $values['emp_job'];
        $fm_employee->save();
        
        return 'Usuario actualizado';
    }

}
