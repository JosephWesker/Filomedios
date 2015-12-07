<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_employee;
use App\fil_business_unit;

class employeeController extends Controller
{
    public function postCreate() {
        $values = Request::all();
        if ($values['emp_first_name'] == '' || $values['emp_first_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Nombre requerido'));
        }
        if ($values['emp_last_name'] == '' || $values['emp_last_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Apellido requerido'));
        }
        if ($values['emp_address'] == '' || $values['emp_address'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Dirección requerido'));
        }
        if ($values['emp_phone_number'] == '' || $values['emp_phone_number'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Número Fijo requerido'));
        }
        if ($values['emp_job'] == '' || $values['emp_job'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Puesto requerido'));
        }
        if ($values['emp_fk_business_unit'] == '' || $values['emp_fk_business_unit'] == null || $values['emp_fk_business_unit'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo Unidad de Negocio requerido'));
        }
        if ($values['emp_email'] == '' || $values['emp_email'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Correo/Usuario requerido'));
        }
        if ($values['emp_password'] == '' || $values['emp_password'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Contraseña requerido'));
        }
        $values['emp_password'] = hash::make($values['emp_password']);
        fil_employee::create($values);
        $response = Response::json(array('success' => true, 'data' => 'Empleado guardado con exito'));
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $data = fil_employee::select(['emp_first_name', 'emp_last_name', 'emp_address', 'emp_phone_number', 'emp_cellphone_number', 'emp_job', 'emp_fk_business_unit', 'emp_email'])->find($values['id']);
        $response = null;
        if ($data == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los datos de los clientes'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $data));
        }
        return $response;
    }
    
    public function postUpdate() {
        $values = Request::all();
        if ($values['emp_first_name'] == '' || $values['emp_first_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Nombre requerido'));
        }
        if ($values['emp_last_name'] == '' || $values['emp_last_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Apellido requerido'));
        }
        if ($values['emp_address'] == '' || $values['emp_address'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Dirección requerido'));
        }
        if ($values['emp_phone_number'] == '' || $values['emp_phone_number'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Número Fijo requerido'));
        }
        if ($values['emp_job'] == '' || $values['emp_job'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Puesto requerido'));
        }
        if ($values['emp_fk_business_unit'] == '' || $values['emp_fk_business_unit'] == null || $values['emp_fk_business_unit'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo Unidad de Negocio requerido'));
        }
        if ($values['emp_email'] == '' || $values['emp_email'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Correo/Usuario requerido'));
        }
        $data = fil_employee::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el empleado a actualizar'));
        }
        $data->emp_first_name = $values['emp_first_name'];
        $data->emp_last_name = $values['emp_last_name'];
        $data->emp_address = $values['emp_address'];
        $data->emp_phone_number = $values['emp_phone_number'];
        $data->emp_cellphone_number = $values['emp_cellphone_number'];
        $data->emp_job = $values['emp_job'];
        $data->emp_fk_business_unit = fil_business_unit::find($values['emp_fk_business_unit'])->bus_id;
        $data->emp_email = $values['emp_email'];
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Empleado actualizado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar el empleado'));
        }
        return $response;
    }
    
    public function postDelete() {
        $values = Request::all();
        $data = fil_employee::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el empleado a eliminar'));
        }
        $response = null;
        if ($data->delete()) {
            $response = Response::json(array('success' => true, 'data' => 'Empleado eliminado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar el empleado'));
        }
        return $response;
    }
    
    public function postReadAll() {
        $data = fil_employee::all();
        foreach ($data as $value) {
            $value->businessUnit;
        }
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los empleados'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }

    public function postReadAllByUnit() {
        $values = Request::all();
        $data = fil_business_unit::find($values['id'])->employees;
        foreach ($data as $value) {
            $value->businessUnit;
        }
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los empleados'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }

    public function loadEmployeesByBusinessUnit($id) {
        $valuesToReturn['id'] = $id;
        $valuesToReturn['name'] = fil_business_unit::find($id)->bus_name;
        return view('usuariosByUnit', $valuesToReturn);
    }
    
    public function postLoadBusinessUnit() {
        $data = fil_business_unit::all(['bus_id', 'bus_name']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer las unidades de negocio'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
}
