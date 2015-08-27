<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\DB;
use App\fm_employee;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class employeeController extends Controller
{
    public function postShowEmployees(){
        $query = fm_employee::select('emp_id','emp_first_name','emp_last_names','emp_address','emp_phone_number','emp_cellphone_number','emp_job')
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
        $fm_employee = fm_employee::find($id)->employees;
        return Response::json($fm_employee);
    }

    public function postCreateEmployee(){
        $values = Request::all();
        
        $email = fm_employee::where('use_username','like', $values['use_username'])->count();
        if($email>0){
            return 'Este correo ya esta registrado, por favor utilize uno diferente';
        }else {

            $matchThese = ['emp_first_name' => $values['emp_first_name'], 'emp_last_names' => $values['emp_last_names']];
            $employee = fm_employee::where($matchThese)->count();
            if ($employee > 0) {
                return 'Este empleado ya esta registrado en la base de datos';
            }else{
                $password_encrypted = Hash::make($values['use_password']);
                $fm_employee = new fm_employee;                    
                $fm_employee->use_username = $values['use_username'];
                $fm_employee->use_password = $password_encrypted;
                $fm_employee->save();

                $fm_employee = new fm_employee([
                    'emp_first_name' => $values['emp_first_name'],
                    'emp_last_names' => $values['emp_last_names'],
                    'emp_address' => $values['emp_address'],
                    'emp_phone_number' => $values['emp_phone_number'],
                    'emp_cellphone_number' => $values['emp_cellphone_number'],
                    'emp_job' => $values['emp_job']
                ]);

                $fm_employee->employees()->save($fm_employee);
                return 'Usuario registrado, su ID de empleado es ' . $fm_employee->emp_id;
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
