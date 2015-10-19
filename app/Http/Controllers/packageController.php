<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_package;
use App\fil_product;
use App\fil_package_detail;

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
    $details = fil_package::find($id)->packagesDetail;
    foreach ($details as $detail) {
      $product = $detail->product;
      $tempRow['pad_id'] = $detail->pad_id;
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
      $tempRow['pad_subtotal'] = (float) $tempRow['pad_finalPrice'] * (float) $detail->pad_validity * (float) $detail->pad_impacts;
      $finalArray[] = $tempRow;
    }
    $data['package'] = fil_package::find($id);
    $data['details'] = $finalArray;
    return view('detalle_paquetes', $data);
  }

  public function postCreateDetail(){
    $values = Request::all();
    fil_package_detail::create($values);
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Paquete guardado con exito'
      ));
    return $response;
  }

  public function postReadDetail(){
    $values = Request::all();
    $data = fil_package::select(['pac_name','pac_description'])->find($values['id']);
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postUpdateDetail(){
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

  public function postDeleteDetail(){
    $values = Request::all();
    $data = fil_package::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Paquete eliminado exitosamente'
      ));
    return $response;
  }

  public function postReadAllDetail(){
    $finalArray = [];
    $details = fil_package::all()->packagesDetail;
    foreach ($details as $detail) {
      $product = $detail->product;
      $tempRow['pad_id'] = $detail->pad_id;
      $tempRow['pro_name'] = $product->pro_name;
      if($product->pro_type == 'transmisión'){
        $tempRow['pro_outlay'] = $product->serviceProyection->spy_outlay;
      }else{
        $tempRow['pro_outlay'] = $product->serviceProduction->spr_outlay;
      }
      $tempRow['pad_impacts'] = $detail->pad_impacts;
      $tempRow['pad_validity'] = $detail->pad_validity.' Días';
      $tempRow['pad_discount'] = ' %';
      if(((float) $detail->pad_discount<=100)){
        $tempRow['pad_finalPrice'] = ((float) $tempRow['pro_outlay'] - ((float) $tempRow['pro_outlay'] * (((float) $detail->pad_discount)/100)));
      }else{
        $tempRow['pad_finalPrice'] = ((float) $tempRow['pro_outlay'] + ((float) $tempRow['pro_outlay'] * (((float) $detail->pad_discount-100)/100)));
      } 
      $tempRow['pad_subtotal'] = (float) $tempRow['pad_finalPrice'] * (float) $detail->pad_validity * (float) $detail->pad_impacts;
      $finalArray[] = $tempRow;
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
    return $response;
  }

  public function postLoadProducts(){
    $response = Response::json(array(
      'success' => true,
      'data'   => fil_product::all(['pro_id','pro_name'])
      ));
    return $response;
  }

  public function postLoadPriceProduct(){
    $values = Request::all();
    $product = fil_product::find($values['pro_id']);
    if($product->pro_type == 'transmisión'){
        return $product->serviceProyection->spy_outlay;
      }else{
        return $product->serviceProduction->spr_outlay;
      }
  }
}