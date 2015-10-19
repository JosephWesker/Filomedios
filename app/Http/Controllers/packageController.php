<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_package;

class packageController extends Controller{
  public function postCreate(){
    $values = Request::all();
    fil_package::create($values);
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Paquete guardado con exito'
      ));
    return $response;
  }

  public function postRead(){
    $values = Request::all();
    $data = fil_package::select(['pac_name','pac_description'])->find($values['id']);
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postUpdate(){
    $values = Request::all();
    $data = fil_package::find($values['id']);
    $data->pac_name = $values['pac_name'];
    $data->pac_description = $values['pac_description'];
    $data->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Paquete actualizado con exito'
      ));
    return $response;
  }

  public function postDelete(){
    $values = Request::all();
    $data = fil_package::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Paquete eliminado exitosamente'
      ));
    return $response;
  }

  public function postReadAll(){
    $data = fil_package::all();
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response;
  }

  public function showDetail($id){
    $finalArray = [];
    $data['detail'] = fil_package::find($id)->packagesDetail;
    foreach ($data['detail'] as $detail) {
      $product = $detail->product;
      $tempRow['pro_id'] = $product->pro_id;
      $tempRow['pro_name'] = $product->pro_name;
      if($product->pro_type == 'transmisión'){
        $tempRow['pro_outlay'] = $product->serviceProyection->spy_outlay;
      }else{
        $tempRow['pro_outlay'] = $product->serviceProduction->spr_outlay;
      }
      $tempRow['pad_impacts'] = $detail->pad_impacts;
      $tempRow['pad_validity'] = $detail->pad_validity.' Días';
      $tempRow['pad_discount'] = $detail->pad_discount.' %';
      $tempRow['pad_finalPrice'] = ((float) $tempRow['pro_outlay'] - ((float) $tempRow['pro_outlay'] * (((float) $detail->pad_discount)/100)));
      $finalArray[] = $tempRow;
    }
    echo json_encode($finalArray);
  }
}
