<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_detail_production;
use App\fil_service_order;
use App\fil_production_registry;

class productionController extends Controller{
  public function getReadDates(){
    $dates = fil_detail_production::all();
    $out = [];
    foreach ($dates as $date) {
      if (($date->serviceOrder->ser_auth_admin == 2) && ($date->serviceOrder->ser_auth_production == 2)&& ($date->serviceOrder->ser_auth_sales == 2)) {
        if ($date->dpr_status == 'Pendiente') {
          $out[] = array(
            'id' => $date->dpr_ser_id,
            'title' => 'Grabación con el cliente '.$date->serviceOrder->customer->cus_contact_first_name.' '.$date->serviceOrder->customer->cus_contact_last_name.', Empresa: '.$date->serviceOrder->customer->cus_commercial_name,
            'url' => '',
            'class' =>'event-important',
            'start' => strtotime($date->dpr_recording_date).'000',
            'end' => strtotime($date->dpr_recording_date).'000' );
          $out[] = array(
            'id' => $date->dpr_ser_id,
            'title' => 'Entrega de la primera propuesta al cliente '.$date->serviceOrder->customer->cus_contact_first_name.' '.$date->serviceOrder->customer->cus_contact_last_name.', Empresa: '.$date->serviceOrder->customer->cus_commercial_name,
            'url' => '',
            'class' =>'event-info',  
            'start' => strtotime($date->dpr_proposal_1_date).'000',
            'end' => strtotime($date->dpr_proposal_1_date).'000' );
          $out[] = array(
            'id' => $date->dpr_ser_id,
            'title' => 'Entrega de la segunda propuesta al cliente '.$date->serviceOrder->customer->cus_contact_first_name.' '.$date->serviceOrder->customer->cus_contact_last_name.', Empresa: '.$date->serviceOrder->customer->cus_commercial_name,
            'url' => '',
            'class' =>'event-info',
            'start' => strtotime($date->dpr_proposal_2_date).'000',
            'end' => strtotime($date->dpr_proposal_2_date).'000' ); 
        }
      }
    }
    $response = Response::json(array(
      'success' => 1,
      'result'   => $out
      ));
    return $response;
  }

  public function postReadDatesByServiceOrder(){
    $order = fil_service_order::find(Request::get('id'));
    $out = [];
    $out[] = array(
      'id' => $order->detailProduction->dpr_ser_id,
      'title' => 'Grabación con el cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name,
      'url' => '',
      'class' =>'event-important',
      'start' => strtotime($order->detailProduction->dpr_recording_date).'000',
      'end' => strtotime($order->detailProduction->dpr_recording_date).'000' );
    $out[] = array(
      'id' => $order->detailProduction->dpr_ser_id,
      'title' => 'Fecha Esperada de entrega de la primera propuesta al cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name,
      'url' => '',
      'class' =>'event-info',  
      'start' => strtotime($order->detailProduction->dpr_proposal_1_date).'000',
      'end' => strtotime($order->detailProduction->dpr_proposal_1_date).'000' );
    $out[] = array(
      'id' => $order->detailProduction->dpr_ser_id,
      'title' => 'Fecha Esperada de entrega de la segunda propuesta al cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name,
      'url' => '',
      'class' =>'event-info',
      'start' => strtotime($order->detailProduction->dpr_proposal_2_date).'000',
      'end' => strtotime($order->detailProduction->dpr_proposal_2_date).'000' );
    if ($order->detailProduction->productionRegistry != null) {
      if ($order->detailProduction->productionRegistry->prr_proposal_1 != null || $order->detailProduction->productionRegistry->prr_proposal_1 != '0000-00-00') {
        $out[] = array(
          'id' => $order->detailProduction->productionRegistry->prr_ser_id,
          'title' => 'Entrega de la primera propuesta al cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name,
          'url' => '',
          'class' =>'event-special',
          'start' => strtotime($order->detailProduction->productionRegistry->prr_proposal_1).'000',
          'end' => strtotime($order->detailProduction->productionRegistry->prr_proposal_1).'000' ); 
      }
      if ($order->detailProduction->productionRegistry->prr_customer_answer_1 != null || $order->detailProduction->productionRegistry->prr_customer_answer_1 != '0000-00-00') {
        $out[] = array(
          'id' => $order->detailProduction->productionRegistry->prr_ser_id,
          'title' => 'primera respuesta cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name.', Comentario del Cliente: '.$order->detailProduction->productionRegistry->prr_customer_answer_1_comment,
          'url' => '',
          'class' =>'event-special',
          'start' => strtotime($order->detailProduction->productionRegistry->prr_customer_answer_1).'000',
          'end' => strtotime($order->detailProduction->productionRegistry->prr_customer_answer_1).'000' ); 
      }
      if ($order->detailProduction->productionRegistry->prr_proposal_2 != null || $order->detailProduction->productionRegistry->prr_proposal_2 != '0000-00-00') {
        $out[] = array(
          'id' => $order->detailProduction->productionRegistry->prr_ser_id,
          'title' => 'Entrega de la segunda propuesta al cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name,
          'url' => '',
          'class' =>'event-special',
          'start' => strtotime($order->detailProduction->productionRegistry->prr_proposal_2).'000',
          'end' => strtotime($order->detailProduction->productionRegistry->prr_proposal_2).'000' ); 
      }
      if ($order->detailProduction->productionRegistry->prr_customer_answer_2 != null || $order->detailProduction->productionRegistry->prr_customer_answer_2 != '0000-00-00') {
        $out[] = array(
          'id' => $order->detailProduction->productionRegistry->prr_ser_id,
          'title' => 'segunda respuesta cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name.', Comentario del Cliente: '.$order->detailProduction->productionRegistry->prr_customer_answer_2_comment,
          'url' => '',
          'class' =>'event-special',
          'start' => strtotime($order->detailProduction->productionRegistry->prr_customer_answer_2).'000',
          'end' => strtotime($order->detailProduction->productionRegistry->prr_customer_answer_2).'000' ); 
      }
      if ($order->detailProduction->productionRegistry->prr_proposal_3 != null || $order->detailProduction->productionRegistry->prr_proposal_3 != '0000-00-00') {
        $out[] = array(
          'id' => $order->detailProduction->productionRegistry->prr_ser_id,
          'title' => 'Entrega de la tercer propuesta al cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name,
          'url' => '',
          'class' =>'event-special',
          'start' => strtotime($order->detailProduction->productionRegistry->prr_proposal_3).'000',
          'end' => strtotime($order->detailProduction->productionRegistry->prr_proposal_3).'000' ); 
      }
      if ($order->detailProduction->productionRegistry->prr_customer_answer_3 != null || $order->detailProduction->productionRegistry->prr_customer_answer_3 != '0000-00-00') {
        $out[] = array(
          'id' => $order->detailProduction->productionRegistry->prr_ser_id,
          'title' => 'tercer respuesta cliente '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', Empresa: '.$order->customer->cus_commercial_name.', Comentario del Cliente: '.$order->detailProduction->productionRegistry->prr_customer_answer_3_comment,
          'url' => '',
          'class' =>'event-special',
          'start' => strtotime($order->detailProduction->productionRegistry->prr_customer_answer_3).'000',
          'end' => strtotime($order->detailProduction->productionRegistry->prr_customer_answer_3).'000' ); 
      }   
    }        
    $response = Response::json(array(
      'success' => 1,
      'result'   => $out
      ));
    return $response;
  }

  public function postReadServiceOrder(){
    $serviceOrders = fil_service_order::orderBy('ser_start_date')->get();
    $serviceOrdersWithProduction = [];
    foreach ($serviceOrders as $order) {
      if ($order->detailProduction!=null) {
        $serviceOrdersWithProduction[] = $order;
      }
    }
    $pending = [];
    $process = [];
    $full = [];
    $historial = [];
    $today = date('Y-m-d');
    $today = date('Y-m-d', strtotime($today));
    foreach ($serviceOrdersWithProduction as $order) {
      if(($order->ser_auth_admin == 2) && ($order->ser_auth_production == 2)&& ($order->ser_auth_sales == 2)){
        if (($today <= date('Y-m-d', strtotime($order->ser_end_date)))) {
          $ArrayToAdd = 'pending';
          switch ($order->detailProduction->dpr_status) {
            case 'Pendiente':
            $ArrayToAdd = 'pending';
            break;              
            case 'En Proceso':
            $ArrayToAdd = 'process';
            break;
            case 'Completa':
            $ArrayToAdd = 'full';
            break;
          }
          switch ($ArrayToAdd) {
            case 'pending':
            $pending[]= array(
              'id' => $order->ser_id,
              'customer' => '<b>Contacto:</b> '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', <b>Empresa:</b> '.$order->customer->cus_commercial_name,
              'start_date' => $order->ser_start_date, );            
            break;              
            case 'process':
            $process[]= array(
              'id' => $order->ser_id,
              'customer' => '<b>Contacto:</b> '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', <b>Empresa:</b> '.$order->customer->cus_commercial_name,
              'start_date' => $order->ser_start_date, );
            break;
            case 'full':
            $full[]= array(
              'id' => $order->ser_id,
              'customer' => '<b>Contacto:</b> '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', <b>Empresa:</b> '.$order->customer->cus_commercial_name,
              'start_date' => $order->ser_start_date, );
            break;
          }          
        }else{
          $historial[]= array(
            'id' => $order->ser_id,
            'customer' => '<b>Contacto:</b> '.$order->customer->cus_contact_first_name.' '.$order->customer->cus_contact_last_name.', <b>Empresa:</b> '.$order->customer->cus_commercial_name,
            'start_date' => $order->ser_start_date, );        
        }        
      }
    }
    $response = Response::json(array(
      'success' => true,
      'pending' => $pending,
      'process' => $process,
      'full' => $full,
      'historial' => $historial
      ));
    return $response;
  }

  public function postInProcess(){
    $order = fil_service_order::find(Request::get('id'));
    if ($order->detailProduction != null) {
      $registry = new fil_production_registry;
      $registry->prr_ser_id = $order->detailProduction->dpr_ser_id;
      $registry->save();
      $order->detailProduction->dpr_status = 'En Proceso';
      $order->detailProduction->save();
    }
    $response = Response::json(array(
      'success' => true,
      'message' => 'Orden de Servicio Actualizada'     
      ));
    return $response;
  }

  public function postCheckRegistry(){
    $order = fil_service_order::find(Request::get('id'));
    $valueToReturn = null;
    $today = date('Y-m-d');    
    $registry = $order->detailProduction->productionRegistry;
    if ($registry->prr_proposal_1 == null || $registry->prr_proposal_1 == '0000-00-00') {
      $registry->prr_proposal_1 = $today;
      $valueToReturn = 'prr_proposal_1';
    }else{
      if ($registry->prr_customer_answer_1 == null || $registry->prr_customer_answer_1 == '0000-00-00') {
        $valueToReturn = 'prr_customer_answer_1';
      }else{
        if ($registry->prr_proposal_2 == null || $registry->prr_proposal_2 == '0000-00-00') {
          $registry->prr_proposal_2 = $today;
          $valueToReturn = 'prr_proposal_2';
        }else{
          if ($registry->prr_customer_answer_2 == null || $registry->prr_customer_answer_2 == '0000-00-00') {
            $valueToReturn = 'prr_customer_answer_2';
          }else{
            if ($registry->prr_proposal_3 == null || $registry->prr_proposal_3 == '0000-00-00') {
              $registry->prr_proposal_3 = $today;
              $valueToReturn = 'prr_proposal_3';
            }else{              
              $valueToReturn = 'prr_customer_answer_3';              
            }
          }
        }
      }
    }
    $registry->save();
    return $valueToReturn;    
  }

  public function postSaveComment(){
    $order = fil_service_order::find(Request::get('id'));    
    $today = date('Y-m-d');    
    $registry = $order->detailProduction->productionRegistry;        
    if ($registry->prr_customer_answer_1 == null || $registry->prr_customer_answer_1 == '0000-00-00') {
      $registry->prr_customer_answer_1 = $today;
      $registry->prr_customer_answer_1_comment = Request::get('comment');          
    }else{          
      if ($registry->prr_customer_answer_2 == null || $registry->prr_customer_answer_2 == '0000-00-00') {
        $registry->prr_customer_answer_2 = $today;
        $registry->prr_customer_answer_2_comment = Request::get('comment');
      }else{            
        $registry->prr_customer_answer_3 = $today;
        $registry->prr_customer_answer_3_comment = Request::get('comment');
      }            
    }        
    if ($this->convertToTinyInt(Request::get('aprobate'))) {
      $registry->prr_customer_approbation = 1;
      $order->detailProduction->dpr_status = 'Completa';
      $order->detailProduction->save();
    }
    $registry->save();
    return 'Respuesta guardada';
  }


  function convertToTinyInt($value){
    if ($value == 'true') {
      return 1;
    }else{
      return 0;
    }
  }
}
