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
