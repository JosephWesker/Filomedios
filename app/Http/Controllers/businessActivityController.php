<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_business_activity;

class businessActivityController extends Controller
{
    public function postCreate() {
        $values = Request::all();
        if ($values['act_name'] == '' || $values['act_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        $rowAtStart = fil_business_activity::count();
        fil_business_activity::create($values);
        $rowAtEnd = fil_business_activity::count();
        $response = null;
        if ($rowAtStart == $rowAtEnd) {
            $response = Response::json(array('success' => false, 'data' => 'Error al registrar en base de datos'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => 'Giro Comercial guardado con exito'));
        }
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $data = fil_business_activity::find($values['id']);
        $response = null;
        if ($data == null) {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los Giros Comerciales'));
        } 
        else {
            $response = Response::json(array('success' => true, 'data' => $data));
        }
        return $response;
    }
    
    public function postUpdate() {
        $values = Request::all();
        if ($values['act_name'] == '' || $values['act_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo nombre requerido'));
        }
        $data = fil_business_activity::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el Giro Comercial a actualizar'));
        }
        $data->act_name = $values['act_name'];
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Giro Comercial actualizado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar el Giro Comercial'));
        }
        return $response;
    }
    
    public function postDelete() {
        $values = Request::all();
        $data = fil_business_activity::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el Giro Comercial a eliminar'));
        }        
        $response = null;
        if ($data->delete()) {
            $response = Response::json(array('success' => true, 'data' => 'Giro Comercial eliminada exitosamente'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar el Giro Comercial'));
        }
        return $response;
    }
    
    public function postReadAll() {
        $data = fil_business_activity::all();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los datos'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
}
