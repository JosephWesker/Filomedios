<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_business_unit;

class businessUnitController extends Controller
{
    public function postCreate() {
        $values = Request::all();
        if ($values['bus_name'] == '' || $values['bus_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        if ($values['bus_address'] == '' || $values['bus_address'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo dirección requerido'));
        }
        $rowAtStart = fil_business_unit::count();
        fil_business_unit::create($values);
        $rowAtEnd = fil_business_unit::count();
        $response = null;
        if ($rowAtStart == $rowAtEnd) {
            $response = Response::json(array('success' => false, 'data' => 'Error al registrar en base de datos'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => 'Unidad de Negocio guardada con exito'));
        }
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $data = fil_business_unit::select(['bus_name', 'bus_address'])->find($values['id']);
        $response = null;
        if ($data == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer las Unidades de Negocio'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $data));
        }
        return $response;
    }
    
    public function postUpdate() {
        $values = Request::all();
        if ($values['bus_name'] == '' || $values['bus_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        if ($values['bus_address'] == '' || $values['bus_address'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo dirección requerido'));
        }
        $data = fil_business_unit::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado la unidad de negocio a actualizar'));
        }
        $data->bus_name = $values['bus_name'];
        $data->bus_address = $values['bus_address'];
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Unidad de Negocio actualizada con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar la Unidad de Negocio'));
        }
        return $response;
    }
    
    public function postDelete() {
        $values = Request::all();
        $data = fil_business_unit::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado la unidad de negocio a eliminar'));
        }        
        if (count($data->employees) != 0) {
            return Response::json(array('success' => false, 'data' => 'Aún hay empleados asignados a esta unidad de negocio, cámbielos de unidad de negocio o elimínelos todos antes de eliminar la unidad'));
        }
        $response = null;
        if ($data->delete()) {
            $response = Response::json(array('success' => true, 'data' => 'unidad de Negocio eliminada exitosamente'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar la Unidad de Negocio'));
        }
        return $response;
    }
    
    public function postReadAll() {
        $data = fil_business_unit::all();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los datos'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
}
