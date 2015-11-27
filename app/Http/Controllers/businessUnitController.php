<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_business_unit;

class businessUnitController extends Controller{
  public function postCreate(){
    $values = Request::all();
    fil_business_unit::create($values);
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Unidad de Negocio guardada con exito'
      ));
    return $response;
  }

  public function postRead(){
    $values = Request::all();
    $data = fil_business_unit::select(['bus_name','bus_address'])->find($values['id']);
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postUpdate(){
    $values = Request::all();
    $data = fil_business_unit::find($values['id']);
    $data->bus_name = $values['bus_name'];
    $data->bus_address = $values['bus_address'];
    $data->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Unidad de Negocio actualizada con exito'
      ));
    return $response;
  }

  public function postDelete(){
    $values = Request::all();
    $data = fil_business_unit::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'unidad de Negocio eliminada exitosamente'
      ));
    return $response;
  }

  public function postReadAll(){
    $data = fil_business_unit::all();
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response;
  }
}
