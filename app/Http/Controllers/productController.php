<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\fm_product;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class productController extends Controller
{
  public function postUpdate(){
    $values = Request::all();
    $product = fm_product::find($values['u_pro_id']);
    $product->pro_media = $values['u_pro_media'];
    $product->pro_description = $values['u_pro_description'];
    $product->pro_outlay = $values['u_pro_outlay'];
    $product->save();
    return 'Producto actualizado';
  }

  function checkMedia($pro_media){
    $result = "";
    switch ($pro_media) {
      case 1:
        $result = "Plaza TV";
        break;
        case 2:
        $result = "www.filomedios.com";
        break;
        case 3:
        $result = "Filomedios HD";
        break;
        case 4:
        $result = "Producciones";
        break;      
    }
    return $result;
  }

  public function postShow(){
    $id = (int) Request::input('id');
    $product = fm_product::find($id);
    return Response::json($product);
  }

  public function postDelate(){
    $id = Request::input('id');
    $product = fm_product::find($id);
    $product->delete();
    return 'Producto eliminado';
  }

  public function postCreate(){
    $values = Request::all();
    $product = new fm_product;
    $product->pro_media = $values['pro_media'];
    $product->pro_description = $values['pro_description'];
    $product->pro_outlay = $values['pro_outlay'];
    $product->save();
    return 'Producto registrado';
  }

  public function postShowAll(){
    $products = fm_product::all();
    foreach ($products as $key) {
      $key->pro_media = $this->checkMedia($key->pro_media);
    }
    return Response::json($products);
  }
}
