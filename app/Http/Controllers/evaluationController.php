<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_employee;
use App\fil_evaluation;
use App\fil_goals;
use App\fil_result;
use App\fil_time;

class evaluationController extends Controller{
  public function postEvaluate(){
    $employees = fil_employee::all();
    $time = $this->getTime();
    foreach ($employees as $employee){
      if ($employee->emp_job == 'vendedor'){
        $existsEvaluation = $this->existsEvaluation($employee); 
        if (!$existsEvaluation){
          $goaCustomerPorcent = $this->calculateCustomerPercent($employee);
          $goaDurationAverage = $this->calculateDurationAverage($employee);
          $goaSalesVolume = $this->calculateSalesVolume($employee);
          $result = new fil_result;
          $result->res_customer_porcent = $goaCustomerPorcent;
          $result->res_duration_average = $goaDurationAverage;
          $result->res_sales_volume = $goaSalesVolume;
          $result->save();
          $evaluation = new fil_evaluation;
          $evaluation->eva_emp_id = $employee->emp_id;
          $evaluation->eva_tim_id = $time->tim_id;
          $evaluation->eva_res_id = $result->res_id;
          $evaluation->eva_goa_id = $this->getGoals()->goa_id;
          $evaluation->save();
        }        
      }
    }
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Evaluaciones Actualizadas'
      ));
    return $response;
  }

  function existsEvaluation($employee){
    $month = ((date('n'))-1);
    if ($month == 0){
      $month = 12;
    }
    $existsEvaluation = false;
    foreach ($employee->evaluations as $evaluation){
      if($evaluation->time->tim_month == $month && $evaluation->time->tim_year == date('Y')){
        $existsEvaluation = true;
      }
    }
    return $existsEvaluation;
  }

  function getGoals(){
    return fil_goals::where('goa_status','=','1')->first();
  }

  function getTime(){
    $times = fil_time::all();
    $month = ((date('n'))-1);
    if ($month == 0){
      $month = 12;
    }
    $needNewTime = true;
    $valueToReturn = null;
    foreach ($times as $time) {
      if ($time->tim_year == date('Y') && $time->tim_month == $month) {
        $valueToReturn = $time;
        $needNewTime == false;
      }
    }
    if ($needNewTime) {
      $valueToReturn = new fil_time;
      switch ($month) {
        case 1:
        case 2:
        case 3:
        $valueToReturn->tim_semester = 1;
        $valueToReturn->tim_trimester = 1;
        break;
        case 4:
        case 5:
        case 6:
        $valueToReturn->tim_semester = 1;
        $valueToReturn->tim_trimester = 2;
        break;
        case 7:
        case 8:
        case 9:
        $valueToReturn->tim_semester = 2;
        $valueToReturn->tim_trimester = 3;
        break;
        case 10:
        case 11:
        case 12:
        $valueToReturn->tim_semester = 2;
        $valueToReturn->tim_trimester = 4;
        break;
      }
      $valueToReturn->tim_month = $month;
      $valueToReturn->tim_year = date('Y');
      $valueToReturn->save();
    }
    return $valueToReturn;
  }

  function calculateCustomerPercent($employee){
    $customersTotal = 0;
    $customersReal = 0;
    $month = ((date('n'))-1);
    if ($month == 0) {
      $month = 12;
    }
    foreach ($employee->customers as $customer) {
      if ((date('n', strtotime($customer->created_at))) == ($month)) {
        $customersTotal++;
        if ($customer->cus_status == 'activo') {
          $customersReal++;
        }
      }
    }
    if ($customersTotal) {
      return (($customersReal*100)/$customersTotal); 
    }else{
      return 0;
    }
    
  }

  function calculateDurationAverage($employee){
    $contDuration = 0;
    $durationTotal = 0;
    foreach ($employee->customers as $customer) {
      foreach ($customer->ServiceOrders as $serviceOrder) {
        $durationTotal += (int) $serviceOrder->ser_duration;
        $contDuration++;
      }
    }
    if ($contDuration) {
      return ($durationTotal/$contDuration);
    }else{
      return 0;
    }
    
  }

  function calculateSalesVolume($employee){
    $sales = 0;
    foreach ($employee->customers as $customer) {
      foreach ($customer->ServiceOrders as $serviceOrder) {
        foreach ($serviceOrder->fil_product_fil_service_order as $detail) {
          $sales += (float) $detail->pso_subtotal;
        }
      }
    }
    return $sales;
  }

  function setGoalsOff(){
    $goals = fil_goals::all();
    foreach ($goals as $goal) {
      $goal->goa_status = 0;
      $goal->save();
    }
  }

  public function postCreateGoal(){
    $values = Request::all();
    $this->setGoalsOff();
    $goal = new fil_goals;
    $goal->goa_customer_porcent = $values['res_customer_porcent'];
    $goal->goa_duration_average = $values['res_duration_average'];
    $goal->goa_sales_volume = $values['res_sales_volume'];
    $goal->goa_status = 1;
    $goal->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Metas Guardadas'
      ));
    return $response;
  }

  public function postReadGoals(){
    $response = Response::json(array(
      'success' => true,
      'data'   => fil_goals::all()
      ));
    return $response;
  }

  public function postActivateGoal(){
    $this->setGoalsOff();
    $goal = fil_goals::find(Request::get('id'));
    $goal->goa_status = 1;
    $goal->save();
    $response = Response::json(array(
      'success' => true,
      'data'   => 'Meta activada'
      ));
    return $response;
  }
}