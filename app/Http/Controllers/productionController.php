<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_detail_production;
use App\fil_service_order;

class productionController extends Controller{
  public function getReadDates(){
    $dates = fil_detail_production::all();
    $out = [];
    foreach ($dates as $date) {
      $out[] = array(
        'id' => $date->dpr_id,
        'title' => 'Grabación con el cliente '/*.$date->detailProduct->serviceOrder->customer->cus_contact_first_name.' '.$date->detailProduct->serviceOrder->customer->cus_contact_last_name*/,
        'url' => '',
        'class' =>'event-important',
        'start' => strtotime($date->dpr_recording_date).'000',
        'end' => strtotime($date->dpr_recording_date).'000' );
      $out[] = array(
        'id' => $date->dpr_id,
        'title' => 'Entrega de la primera propuesta al cliente '/*.$date->detailProduct->serviceOrder->customer->cus_contact_first_name.' '.$date->detailProduct->serviceOrder->customer->cus_contact_last_name*/,
        'url' => '',
        'class' =>'event-info',  
        'start' => strtotime($date->dpr_proposal_1_date).'000',
        'end' => strtotime($date->dpr_proposal_1_date).'000' );
      $out[] = array(
        'id' => $date->dpr_id,
        'title' => 'Entrega de la segunda propuesta al cliente '/*.$date->detailProduct->serviceOrder->customer->cus_contact_first_name.' '.$date->detailProduct->serviceOrder->customer->cus_contact_last_name*/,
        'url' => '',
        'class' =>'event-info',
        'start' => strtotime($date->dpr_proposal_2_date).'000',
        'end' => strtotime($date->dpr_proposal_2_date).'000' ); 
    }
    $response = Response::json(array(
      'success' => 1,
      'result'   => $out
      ));
    return $response;
  }

  public function postReadServiceOrder(){
    $serviceOrders = fil_service_order::orderBy('ser_start_date')->get();
    $out = [];
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));
    foreach ($serviceOrders as $order) {
      if(($today <= date('Y-m-d', strtotime($order->ser_end_date))) && ($order->ser_auth_admin == 2) && ($order->ser_auth_production == 2)&& ($order->ser_auth_sales == 2)){
        $out[]= array(
          'id' => $order->ser_id,
          'customer' => $order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name,
          'start_date' => $order->ser_start_date, );
      }
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => $out
      ));
    return $response;
  }
}
