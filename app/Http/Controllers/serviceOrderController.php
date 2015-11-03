<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_customer;
use App\fil_product;
use App\fil_business_unit;
use App\fil_show;
use App\fil_package;

class serviceOrderController extends Controller{

  public function postReadCustomers(){
    $finalArray = [];
    $customers = fil_customer::all();
    foreach ($customers as $value) {
      $row['cus_id'] = $value->cus_id;
      $row['cus_commercial_name'] = $value->cus_commercial_name;
      $row['cus_contact'] = $value->cus_contact_first_name.' '.$value->cus_contact_last_name;
      $row['tax_business_name'] = $value->taxData->tax_business_name;
      $row['tax_rfc'] = $value->taxData->tax_rfc;
      $finalArray[] = $row;
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
    return $response;
  }

  public function postLoadProductsData(){
    $products = fil_product::all();
    $finalArray = [];
    foreach ($products as $value) {
      $row['pro_id'] = $value->pro_id;
      $row['pro_name'] = $value->pro_name;
      $row['pro_type'] = $value->pro_type;
      if($value->pro_type == 'transmisión'){
        $row['pro_extra'] = $value->serviceProyection;
      }else{
        $row['pro_extra'] = $value->serviceProduction;
      }
      $finalArray[] = $row;
    }
    return $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
  }

  public function postLoadSelects(){
    $shows = fil_show::all(['sho_id','sho_name']);
    $businessUnits = fil_business_unit::all(['bus_id','bus_name']);
    return $response = Response::json(array(
      'success' => true,
      'show' => $shows,
      'businessUnit' => $businessUnits
    ));
  }

  public function postLoadPackages(){
    $response = Response::json(array(
      'success' => true,
      'data'   => fil_package::all(['pac_id','pac_name'])
      ));
    return $response;
  }

  public function postLoadPackagesDetail(){
    $values = Request::all();
    $package = fil_package::find($values['id']);
    $detail = $package->packagesDetail;
    $finalArray = [];
    foreach ($detail as $value) {
      $row = [];
      $row['det_fk_product'] = $value->product->pro_id;
      $row['det_name'] = $value->product->pro_name;
      $row['det_fk_business_unit'] = null;

      if($value->product->serviceProyection->spy_has_show){
        $row['det_fk_show'] = null;
      };

      if($value->product->serviceProyection->spy_has_transmission_scheme == 1){
        $row['det_has_transmission_scheme'] = null;
      };

      $row['det_impacts'] = $value->pad_impacts;
      $row['det_validity'] = $value->pad_validity;
      $row['det_discount'] = $value->pad_discount;      
      $row['det_final_price'] = $value->pad_final_price; 

      if (($value->product->serviceProyection->spy_proyection_media == 'televisión') and ($value->product->serviceProyection->spy_has_show == "0")) {
        $row['det_subtotal'] = (float) $row['det_final_price'] * (float) $row['det_validity'] * (float) $row['det_impacts'] * 10;
      }else{
        $row['det_subtotal'] = (float) $row['det_final_price'] * (float) $row['det_validity'] * (float) $row['det_impacts'];
      }

      $finalArray[] = $row;
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => $finalArray
      ));
    return $response;
  }

}
