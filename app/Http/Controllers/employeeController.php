<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use App\fm_employee;
use Illuminate\Routing\Controller;

class employeeController extends Controller
{
    public function anyShowEmployee($id){
        $fm_employee = fm_employee::find($id);
    }

    public function postCreateEmployee(){
        $values = Request::all();
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
    }

    public function anyDelateEmployee($id){
        $fm_employee = fm_employee::find($id);
        $fm_employee->delete();
    }

    public function anyUpdateEmployee($values,$id){
        $fm_employee = fm_employee::find($id);
        $fm_employee->emp_first_name = $values['emp_first_name'];
        $fm_employee->emp_last_name = $values['emp_last_name'];
        $fm_employee->emp_last_name2 = $values['emp_last_name2'];
        $fm_employee->emp_address = $values['emp_address'];
        $fm_employee->emp_phone_number = $values['emp_phone_number'];
        $fm_employee->emp_cellphone_number = $values['emp_cellphone_number'];
        $fm_employee->emp_email = $values['emp_email'];
        $fm_employee->emp_job = $values['emp_job'];
        $fm_employee->save();
    }

}
