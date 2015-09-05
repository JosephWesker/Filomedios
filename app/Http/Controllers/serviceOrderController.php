<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\fm_customer;
use App\fm_tax_data;
use App\fm_id_helper;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;

class serviceOrderController extends Controller
{

  public function checkIdHelper(){
    $idHelper = fm_id_helper::find(1);
    $year = date("Y");    
    if($idHelper->id_year != $year){
      $idHelper->id_year = $year;
      $idHelper->id_number = 1;
      $idHelper->save();
    }
    $idNumber = $idHelper->id_number;
    $number = "";
    switch(strlen((string)$idNumber)){
      case 1:
      $number = '000'.$idHelper->id_number;
      break;
      case 2:
      $number = '00'.$idHelper->id_number;
      break;    
      case 3:
      $number = '0'.$idHelper->id_number;
      break;
      case 4:
      $number = $idHelper->id_number;
      break;
    }    
    $idHelper->id_number = ($idNumber+1);
    $idHelper->save();
    return ($number."/".$year);
  }


  public function postCreateServiceOrder(){
    $values = Request::all();    
  }
}
