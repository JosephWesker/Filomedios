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

class productionController extends Controller
{
    public function getReadDates() {
        $dates = fil_detail_production::all();
        $out = [];
        $addToView = false;
        foreach ($dates as $date) {
            if (($order->detailProduct->serviceOrder->ser_auth_admin == 2) && ($order->detailProduct->serviceOrder->ser_auth_production == 2) && ($order->detailProduct->serviceOrder->ser_auth_sales == 2)) {
                $addToView = true;
            }
            if ($addToView) {
                if ($date->dpr_status == 'Pendiente') {
                    $out[] = array('id' => $date->dpr_id, 'title' => 'Grabación con el cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-important', 'start' => strtotime($date->dpr_recording_date) . '000', 'end' => strtotime($date->dpr_recording_date) . '000');
                    $out[] = array('id' => $date->dpr_id, 'title' => 'Entrega de la primera propuesta al cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-info', 'start' => strtotime($date->dpr_proposal_1_date) . '000', 'end' => strtotime($date->dpr_proposal_1_date) . '000');
                    $out[] = array('id' => $date->dpr_id, 'title' => 'Entrega de la segunda propuesta al cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-info', 'start' => strtotime($date->dpr_proposal_2_date) . '000', 'end' => strtotime($date->dpr_proposal_2_date) . '000');
                }
            }
        }
        $response = Response::json(array('success' => 1, 'result' => $out));
        return $response;
    }
    
    public function postReadDatesByServiceOrder() {
        $products = fil_service_order::find(Request::get('id'))->detailsProducts;
        if ($products == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer las fechas de la Orden de Servicio'));
        }
        $dates = [];
        foreach ($products as $product) {
            if ($product->detailProduction != null) {
                $dates[] = $product->detailProduction;
            }
        }
        $out = [];
        foreach ($dates as $date) {
            $out[] = array('id' => $date->dpr_id, 'title' => 'Grabación con el cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-important', 'start' => strtotime($date->dpr_recording_date) . '000', 'end' => strtotime($date->dpr_recording_date) . '000');
            $out[] = array('id' => $date->dpr_id, 'title' => 'Fecha Esperada de entrega de la primera propuesta al cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-info', 'start' => strtotime($date->dpr_proposal_1_date) . '000', 'end' => strtotime($date->dpr_proposal_1_date) . '000');
            $out[] = array('id' => $date->dpr_id, 'title' => 'Fecha Esperada de entrega de la segunda propuesta al cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-info', 'start' => strtotime($date->dpr_proposal_2_date) . '000', 'end' => strtotime($date->dpr_proposal_2_date) . '000');
            if ($date->productionRegistry != null) {
                if ($date->productionRegistry->prr_proposal_1 != null || $date->productionRegistry->prr_proposal_1 != '0000-00-00') {
                    $out[] = array('id' => $date->productionRegistry->prr_id, 'title' => 'Entrega de la primera propuesta al cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-special', 'start' => strtotime($date->productionRegistry->prr_proposal_1) . '000', 'end' => strtotime($date->productionRegistry->prr_proposal_1) . '000');
                }
                if ($date->productionRegistry->prr_customer_answer_1 != null || $date->productionRegistry->prr_customer_answer_1 != '0000-00-00') {
                    $out[] = array('id' => $date->productionRegistry->prr_id, 'title' => 'primera respuesta cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name . ', Comentario del Cliente: ' . $date->productionRegistry->prr_customer_answer_1_comment, 'url' => '', 'class' => 'event-special', 'start' => strtotime($date->productionRegistry->prr_customer_answer_1) . '000', 'end' => strtotime($date->productionRegistry->prr_customer_answer_1) . '000');
                }
                if ($date->productionRegistry->prr_proposal_2 != null || $date->productionRegistry->prr_proposal_2 != '0000-00-00') {
                    $out[] = array('id' => $date->productionRegistry->prr_id, 'title' => 'Entrega de la segunda propuesta al cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-special', 'start' => strtotime($date->productionRegistry->prr_proposal_2) . '000', 'end' => strtotime($date->productionRegistry->prr_proposal_2) . '000');
                }
                if ($date->productionRegistry->prr_customer_answer_2 != null || $date->productionRegistry->prr_customer_answer_2 != '0000-00-00') {
                    $out[] = array('id' => $date->productionRegistry->prr_id, 'title' => 'segunda respuesta cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name . ', Comentario del Cliente: ' . $date->productionRegistry->prr_customer_answer_2_comment, 'url' => '', 'class' => 'event-special', 'start' => strtotime($date->productionRegistry->prr_customer_answer_2) . '000', 'end' => strtotime($date->productionRegistry->prr_customer_answer_2) . '000');
                }
                if ($date->productionRegistry->prr_proposal_3 != null || $date->productionRegistry->prr_proposal_3 != '0000-00-00') {
                    $out[] = array('id' => $date->productionRegistry->prr_id, 'title' => 'Entrega de la tercer propuesta al cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name, 'url' => '', 'class' => 'event-special', 'start' => strtotime($date->productionRegistry->prr_proposal_3) . '000', 'end' => strtotime($date->productionRegistry->prr_proposal_3) . '000');
                }
                if ($date->productionRegistry->prr_customer_answer_3 != null || $date->productionRegistry->prr_customer_answer_3 != '0000-00-00') {
                    $out[] = array('id' => $date->productionRegistry->prr_id, 'title' => 'tercer respuesta cliente ' . $date->detailProduct->serviceOrder->customer->cus_contact_first_name . ' ' . $date->detailProduct->serviceOrder->customer->cus_contact_last_name . ', Empresa: ' . $date->detailProduct->serviceOrder->customer->cus_commercial_name . ', Comentario del Cliente: ' . $date->productionRegistry->prr_customer_answer_3_comment, 'url' => '', 'class' => 'event-special', 'start' => strtotime($date->productionRegistry->prr_customer_answer_3) . '000', 'end' => strtotime($date->productionRegistry->prr_customer_answer_3) . '000');
                }
            }
        }
        $response = Response::json(array('success' => 1, 'result' => $out));
        return $response;
    }
    
    public function postReadServiceOrder() {
        $serviceOrders = fil_service_order::orderBy('ser_start_date')->get();
        if ($serviceOrders == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer las ordenes de servicio'));
        }
        $serviceOrdersWithProduction = [];
        foreach ($serviceOrders as $order) {
            $add = false;
            foreach ($order->detailsProducts as $detail) {
                if ($detail->detailProduction != null) {
                    $add = true;
                }
            }
            if ($add) {
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
            if (($order->ser_auth_admin == 2) && ($order->ser_auth_production == 2) && ($order->ser_auth_sales == 2)) {
                if (($today <= date('Y-m-d', strtotime($order->ser_end_date)))) {
                    $ArrayToAdd = 'pending';
                    foreach ($order->detailsProducts as $detail) {
                        if ($detail->detailProduction != null) {
                            switch ($detail->detailProduction->dpr_status) {
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
                        }
                    }
                    switch ($ArrayToAdd) {
                        case 'pending':
                            $pending[] = array('id' => $order->ser_id, 'customer' => '<b>Contacto:</b> ' . $order->customer->cus_contact_first_name . ' ' . $order->customer->cus_contact_last_name . ', <b>Empresa:</b> ' . $order->customer->cus_commercial_name, 'start_date' => $order->ser_start_date,);
                            break;

                        case 'process':
                            $process[] = array('id' => $order->ser_id, 'customer' => '<b>Contacto:</b> ' . $order->customer->cus_contact_first_name . ' ' . $order->customer->cus_contact_last_name . ', <b>Empresa:</b> ' . $order->customer->cus_commercial_name, 'start_date' => $order->ser_start_date,);
                            break;

                        case 'full':
                            $full[] = array('id' => $order->ser_id, 'customer' => '<b>Contacto:</b> ' . $order->customer->cus_contact_first_name . ' ' . $order->customer->cus_contact_last_name . ', <b>Empresa:</b> ' . $order->customer->cus_commercial_name, 'start_date' => $order->ser_start_date,);
                            break;
                    }
                } 
                else {
                    $historial[] = array('id' => $order->ser_id, 'customer' => '<b>Contacto:</b> ' . $order->customer->cus_contact_first_name . ' ' . $order->customer->cus_contact_last_name . ', <b>Empresa:</b> ' . $order->customer->cus_commercial_name, 'start_date' => $order->ser_start_date,);
                }
            }
        }
        $response = Response::json(array('success' => true, 'pending' => $pending, 'process' => $process, 'full' => $full, 'historial' => $historial));
        return $response;
    }
    
    public function postInProcess() {
        $order = fil_service_order::find(Request::get('id'));
        if ($order == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer orden de servicio'));
        }
        foreach ($order->detailsProducts as $detail) {
            if ($detail->detailProduction != null) {
                $registry = new fil_production_registry;
                $registry->prr_id = $detail->detailProduction->dpr_id;
                if (!$registry->save()) {
                    return Response::json(array('success' => false, 'data' => 'Error al guardar el registro'));
                }
                $detail->detailProduction->dpr_status = 'En Proceso';
                if (!$detail->detailProduction->save()) {
                    return Response::json(array('success' => false, 'data' => 'Error al guardar el registro'));
                }
            }
        }
        $response = Response::json(array('success' => true, 'message' => 'Orden de Servicio Actualizada'));
        return $response;
    }
    
    public function postCheckRegistry() {
        $order = fil_service_order::find(Request::get('id'));
        if ($order == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer orden de servicio'));
        }
        $valueToReturn = null;
        $today = date('Y-m-d');
        foreach ($order->detailsProducts as $detail) {
            if ($detail->detailProduction != null) {
                $registry = $detail->detailProduction->productionRegistry;
                if ($registry->prr_proposal_1 == null || $registry->prr_proposal_1 == '0000-00-00') {
                    $registry->prr_proposal_1 = $today;
                    $valueToReturn = 'prr_proposal_1';
                } 
                else {
                    if ($registry->prr_customer_answer_1 == null || $registry->prr_customer_answer_1 == '0000-00-00') {
                        $valueToReturn = 'prr_customer_answer_1';
                    } 
                    else {
                        if ($registry->prr_proposal_2 == null || $registry->prr_proposal_2 == '0000-00-00') {
                            $registry->prr_proposal_2 = $today;
                            $valueToReturn = 'prr_proposal_2';
                        } 
                        else {
                            if ($registry->prr_customer_answer_2 == null || $registry->prr_customer_answer_2 == '0000-00-00') {
                                $valueToReturn = 'prr_customer_answer_2';
                            } 
                            else {
                                if ($registry->prr_proposal_3 == null || $registry->prr_proposal_3 == '0000-00-00') {
                                    $registry->prr_proposal_3 = $today;
                                    $valueToReturn = 'prr_proposal_3';
                                } 
                                else {
                                    $valueToReturn = 'prr_customer_answer_3';
                                }
                            }
                        }
                    }
                }
                if (!$registry->save()) {
                    return Response::json(array('success' => false, 'data' => 'Error al guardar el registro'));
                }
            }
        }
        return Response::json(array('success' => false, 'data' => $valueToReturn));
    }
    
    public function postSaveComment() {
        $order = fil_service_order::find(Request::get('id'));
        if ($order == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer orden de servicio'));
        }
        if (Request::get('comment') == '' || Request::get('comment') == null) {
            return Response::json(array('success' => false, 'data' => 'Comentario requerido'));
        }
        $today = date('Y-m-d');
        foreach ($order->detailsProducts as $detail) {
            if ($detail->detailProduction != null) {
                $registry = $detail->detailProduction->productionRegistry;
                if ($registry->prr_customer_answer_1 == null || $registry->prr_customer_answer_1 == '0000-00-00') {
                    $registry->prr_customer_answer_1 = $today;
                    $registry->prr_customer_answer_1_comment = Request::get('comment');
                } 
                else {
                    if ($registry->prr_customer_answer_2 == null || $registry->prr_customer_answer_2 == '0000-00-00') {
                        $registry->prr_customer_answer_2 = $today;
                        $registry->prr_customer_answer_2_comment = Request::get('comment');
                    } 
                    else {
                        $registry->prr_customer_answer_3 = $today;
                        $registry->prr_customer_answer_3_comment = Request::get('comment');
                    }
                }
                if ($this->convertToBoolean(Request::get('aprobate'))) {
                    $registry->prr_customer_approbation = 1;
                    $detail->detailProduction->dpr_status = 'Completa';
                    if (!$detail->detailProduction->save()) {
                        return Response::json(array('success' => false, 'data' => 'Error al guardar el registro'));
                    }
                }
                if (!$registry->save()) {
                    return Response::json(array('success' => false, 'data' => 'Error al guardar el registro'));
                }
            }
        }
        return 'Respuesta guardada';
    }
    
    function convertToBoolean($string) {
        if ($string == 'true') {
            return true;
        } 
        else {
            return false;
        }
    }
}
