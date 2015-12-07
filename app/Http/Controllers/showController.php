<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_show;

class showController extends Controller
{
    public function postCreate() {
        $values = Request::all();
        if ($values['sho_name'] == '' || $values['sho_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Nombre requerido'));
        }
        if ($values['sho_description'] == '' || $values['sho_description'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Descripción requerido'));
        }
        if ($values['sho_media'] == '' || $values['sho_media'] == null || $values['sho_media'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo Medio de transmisión requerido'));
        }
        fil_show::create($values);
        $response = Response::json(array('success' => true, 'data' => 'Programa guardado con exito'));
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $data = fil_show::select(['sho_name', 'sho_description', 'sho_media'])->find($values['id']);
        $response = null;
        if ($data != null) {
            $response = Response::json(array('success' => true, 'data' => $data));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Error al leer los datos del programa'));
        }
        
        return $response;
    }
    
    public function postUpdate() {
        $values = Request::all();
        if ($values['sho_name'] == '' || $values['sho_name'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Nombre requerido'));
        }
        if ($values['sho_description'] == '' || $values['sho_description'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo Descripción requerido'));
        }
        if ($values['sho_media'] == '' || $values['sho_media'] == null || $values['sho_media'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo Medio de transmisión requerido'));
        }
        $data = fil_show::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el programa a actualizar'));
        }
        $data->sho_name = $values['sho_name'];
        $data->sho_description = $values['sho_description'];
        $data->sho_description = $values['sho_media'];
        $response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Programa actualizado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al guardar el programa'));
        }
        return $response;
    }
    
    public function postDelete() {
        $values = Request::all();
        $data = fil_show::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el programa a eliminar'));
        }
        $Response = null;
        if ($data->delete()) {
            $response = Response::json(array('success' => true, 'data' => 'Programa eliminado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar el programa'));
        }
        $response = Response::json(array('success' => true, 'data' => 'Programa eliminado exitosamente'));
        return $response;
    }
    
    public function postReadAll() {
        $data = fil_show::all();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los datos de los programas'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }
}
