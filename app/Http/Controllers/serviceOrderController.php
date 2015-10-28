<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_customer;

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

}
