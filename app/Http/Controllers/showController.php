<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_show;

class showController extends Controller{
  public function postCreate(){
    $values = Request::all();
    fil_show::create($values);
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Programa guardado con exito'
      ));
    return $response;
  }

  public function postRead(){
    $values = Request::all();
    $data = fil_show::select(['sho_name','sho_description'])->find($values['id']);
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response; 
  }

  public function postUpdate(){
    $values = Request::all();
    $data = fil_show::find($values['id']);
    $data->sho_name = $values['sho_name'];
    $data->sho_description = $values['sho_description'];
    $data->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Programa actualizado con exito'
      ));
    return $response;
  }

  public function postDelete(){
    $values = Request::all();
    $data = fil_show::find($values['id']);
    $data->delete();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Programa eliminada exitosamente'
      ));
    return $response;
  }

  public function postReadAll(){
    $data = fil_show::all();
    $response = Response::json(array(
      'success' => true,
      'data'   => $data
      ));
    return $response;
  }
}
