<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_product;
use App\fil_web;
use App\fil_spot;
use App\fil_show;
use App\fil_production;


class productController extends Controller{
  public function postCreate(){

    $values = Request::all();
    $product = new fil_product;
    $product->pro_name = $values['pro_name'];
    $product->pro_description = $values['pro_description'];
    $product->pro_outlay = $values['pro_outlay'];
    $product->pro_type = $values['pro_type'];
    $product->save();
    $productType = null;
    switch ($values['pro_type']) {
      case 'Spot':
        $productType = new fil_spot;
        $productType->spo_pro_id = $product->pro_id;
        $productType->spo_impacts = $values['spo_impacts'];
        $productType->spo_duration = $values['spo_duration'];
      break;
      case 'Web':
        $productType = new fil_web;
        $productType->web_pro_id = $product->pro_id;
        $productType->web_validity = $values['web_validity'];
        $productType->web_media = $values['web_media'];
      break;
      case 'Programa':
        $productType = new fil_show;
        $productType->sho_pro_id = $product->pro_id;
        $productType->sho_duration = $values['sho_duration'];
      break;
      case 'Producción':
        $productType = new fil_production;
        $productType->prd_pro_id = $product->pro_id;
        $productType->prd_need_dates = $this->convertToTinyint($values['prd_need_dates']);
      break;
    }
    $productType->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Producto guardado con exito'
      ));
    return $response;
  }

  public function postRead(){
    $values = Request::all();
    $data = fil_product::find($values['id']);
    switch ($data->pro_type) {
      case 'Spot':
        $data->spot; 
      break;
      case 'Web':
        $data->web;
      break;
      case 'Programa':
        $data->show;
      break;
      case 'Producción':
        $data->production;
      break;
    }    
    $response = Response::json(array(
      'success' => true,
      'data' => $data
      ));
    return $response; 
  }

  public function postUpdate(){
    $values = Request::all();
    $product = fil_product::find($values['id']);
    $product->pro_name = $values['pro_name'];
    $product->pro_description = $values['pro_description'];
    $product->pro_outlay = $values['pro_outlay'];
    $product->pro_type = $values['pro_type'];
    $product->save();
    $productType = null;
    switch ($values['pro_type']) {
      case 'Spot':
        $productType = $product->spot;
        $productType->spo_impacts = $values['spo_impacts'];
        $productType->spo_duration = $values['spo_duration'];
      break;
      case 'Web':
        $productType = $product->web;
        $productType->web_validity = $values['web_validity'];
        $productType->web_media = $values['web_media'];
      break;
      case 'Programa':
        $productType = $product->show;
        $productType->sho_duration = $values['sho_duration'];
      break;
      case 'Producción':
        $productType = $product->production;
        $productType->prd_need_dates = $this->convertToTinyint($values['prd_need_dates']);
      break;
    }
    $productType->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Producto actualizado con exito'
      ));
    return $response;
  }

  public function postDelete(){
    $values = Request::all();
    $data = fil_product::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Producto eliminado exitosamente'
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

  function convertToTinyint($value){
    if($value=='true'){
      return 1;
    }else{
      return 0;
    } 
  }

  function convertToYesNo($value){
    if($value=='1'){
      return 'Si';
    }else{
      return 'No';
    } 
  }

  function checkDuration($value){
    if($value==0){
      return 'No tiene';
    }else{
      return $value;
    }
  }
}
