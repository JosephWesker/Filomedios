<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_product;

class productController extends Controller{
  public function postCreate(){
    $values = Request::all();
    fil_product::create($values);
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Producto guardada con exito'
      ));
    return $response;
  }

  public function postRead(){
    $values = Request::all();
    $data = fil_product::select(['pro_name','pro_type','pro_description','pro_has_show','pro_has_scheme','pro_has_production_registry','pro_duration_type','pro_duration','pro_daily_impacts','pro_outlay'])->find($values['id']);
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postUpdate(){
    $values = Request::all();
    $data = fil_product::find($values['id']);
    $data->pro_name = $values['pro_name'];
    $data->pro_type = $values['pro_type'];
    $data->pro_description = $values['pro_description'];
    $data->pro_has_show = $values['pro_has_show'];
    $data->pro_has_scheme = $values['pro_has_scheme'];
    $data->pro_has_production_registry = $values['pro_has_production_registry'];
    $data->pro_duration_type = $values['pro_duration_type'];
    $data->pro_duration = $values['pro_duration'];
    $data->pro_daily_impacts = $values['pro_daily_impacts'];
    $data->pro_outlay = $values['pro_outlay'];
    $data->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Producto actualizada con exito'
      ));
    return $response;
  }

  public function postDelete(){
    $values = Request::all();
    $data = fil_product::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Producto eliminada exitosamente'
      ));
    return $response;
  }

  public function postReadAll(){
    $data = fil_product::all();
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response;
  }
}
