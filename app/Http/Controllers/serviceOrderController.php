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

}
