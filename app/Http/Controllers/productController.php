<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_product;
use App\fil_service_production;
use App\fil_service_proyection;


class productController extends Controller{
  public function postCreate(){

    $values = Request::all();
    $product = new fil_product;
    $product->pro_name = $values['pro_name'];
    $product->pro_description = $values['pro_description'];
    $product->pro_type = $values['pro_type'];
    $product->save();

    if($product->pro_type == 'transmision'){
      
      $fil_service = new fil_service_proyection;
      $fil_service->spy_id = $product->pro_id;
      $fil_service->spy_proyection_media = $values['spy_proyection_media'];
      $fil_service->spy_has_show = $this->convertString($values['spy_has_show']);
      $fil_service->spy_has_transmission_scheme = $this->convertString($values['spy_has_transmission_scheme']);

      if($values['spy_has_duration'] == 'true'){
        $fil_service->spy_duration = $values['spy_duration'];
      }else{
        $fil_service->spy_duration = NULL;
      }
      $fil_service->spy_outlay = $values['spy_outlay'];
      $fil_service->save();

    }else{

      $fil_service = new fil_service_production;
      $fil_service->spr_id = $product->pro_id;
      $fil_service->spr_has_production_registry = $this->convertString($values['spr_has_production_registry']);
      $fil_service->spr_outlay = $values['spr_outlay'];
      $fil_service->save();

    }  
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

  function convertString($value){
    if($value=='true'){
      return 1;
    }else{
      return 0;
    } 
  }
}
