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
        if ($values['sho_impacts'] == '' || $values['sho_impacts'] == null || $values['sho_impacts'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo impactos requerido'));
        }
        if ($values['sho_duration'] == '' || $values['sho_duration'] == null || $values['sho_duration'] == 'null' || $values['sho_duration'] == '00:00:00') {
            return Response::json(array('success' => false, 'data' => 'Campos de duración requeridos'));
        }
        $values['sho_status'] = 'activo';
        fil_show::create($values);
        $response = Response::json(array('success' => true, 'data' => 'Programa guardado con exito'));
        return $response;
    }
    
    public function postRead() {
        $values = Request::all();
        $data = fil_show::select(['sho_name', 'sho_description', 'sho_media','sho_impacts','sho_duration'])->find($values['id']);
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
        if ($values['sho_impacts'] == '' || $values['sho_impacts'] == null || $values['sho_impacts'] == 'null') {
            return Response::json(array('success' => false, 'data' => 'Campo impactos requerido'));
        }
        if ($values['sho_duration'] == '' || $values['sho_duration'] == null || $values['sho_duration'] == 'null' || $values['sho_duration'] == '00:00:00') {
            return Response::json(array('success' => false, 'data' => 'Campos de duración requeridos'));
        }
        $data = fil_show::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el programa a actualizar'));
        }
        $data->sho_name = $values['sho_name'];
        $data->sho_description = $values['sho_description'];
        $data->sho_media = $values['sho_media'];
        $data->sho_impacts = $values['sho_impacts'];
        $data->sho_duration = $values['sho_duration'];
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
        $data->sho_status = 'eliminado';
        $Response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Programa eliminado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al eliminar el programa'));
        }
        return $response;
    }
    
    public function postReadAll() {
        $data = fil_show::where('sho_status','like','activo')->get();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los datos de los programas'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }

    public function postReadAllDelete() {
        $data = fil_show::where('sho_status','like','eliminado')->get();
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los datos de los programas'));
        }
        $response = Response::json(array('success' => true, 'data' => $data));
        return $response;
    }

    public function postActivate() {
        $values = Request::all();
        $data = fil_show::find($values['id']);
        if ($data == null) {
            return Response::json(array('success' => false, 'data' => 'No se ha encontrado el programa a restaurar'));
        }
        $data->sho_status = 'activo';
        $Response = null;
        if ($data->save()) {
            $response = Response::json(array('success' => true, 'data' => 'Programa restaurado con exito'));
        } 
        else {
            $response = Response::json(array('success' => false, 'data' => 'Ocurrió un error al restaurar el programa'));
        }
        return $response;
    }
}
