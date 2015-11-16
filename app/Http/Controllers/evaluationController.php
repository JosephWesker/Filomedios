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
  public function evaluate(){    
    $employees = fil_employee::all();
    foreach ($employees as $employee) {
      if ($employee->emp_job == 'vendedor') {
        $goaCustomerPorcent = $this->calculateCustomerPercent($employee);
        $goaDurationAverage = $this->calculateDurationAverage($employee);
        $goaSalesVolume = $this->calculateSalesVolume($employee);
        $time = new fil_time;
        $month = (date('n'))-1);
        if ($month == 0) {
          $month = 12;
        }
        switch ($month) {
          case 1:
          case 2:
          case 3:
            $time->tim_semester = 1;
            $time->tim_trimester = 1;
            break;
          case 4:
          case 5:
          case 6:
            $time->tim_semester = 1;
            $time->tim_trimester = 2;
            break;
          case 7:
          case 8:
          case 9:
            $time->tim_semester = 2;
            $time->tim_trimester = 3;
            break;
          case 10:
          case 11:
          case 12:
            $time->tim_semester = 2;
            $time->tim_trimester = 4;
            break;
        }
        $time->tim_month = $month;
        $time->tim_year = date('Y');
        $time->save();
        $result = new fil_result;
        $result->res_customer_porcent = $goaCustomerPorcent;
        $result->res_duration_average = $goaDurationAverage;
        $result->res_sales_volume = $goaSalesVolume;
        $result->save();
        $evaluation = new fil_evaluation;
        $evaluation->eva_emp_id = $employee->emp_id;
        $evaluation->eva_tim_id = $time->tim_id;
        $evaluation->eva_res_id = $result->res_id;
        $evaluation->save();
      }
    }
  }

  public function calculateCustomerPercent($employee){
    $customersTotal = 0;
    $customersReal = 0;
    
    foreach ($employee->customers as $customer) {
      $month = (date('n'))-1);
      if ($month == 0) {
        $month = 12;
      }
      if (date('n', strtotime($customer->created_at)) == ($month) {
        $customersTotal++;
        if ($customer->cus_status == 'activo') {
          $customersReal++;
        }
      }
    }
    return (($customersReal*100)/$customersTotal); 
  }

  public function calculateDurationAverage($employee){
    $contDuration = 0;
    $durationTotal = 0;
    foreach ($employee->customer as $customer) {
      foreach ($customer->ServiceOrders as $serviceOrder) {
        $durationTotal += (int) $serviceOrder->ser_duration;
        $contDuration++;
      }
    }
    return ($durationTotal/$contDuration)
  }

  public function calculateSalesVolume($employee){
    $sales = 0;
    foreach ($employee->customer as $customer) {
      foreach ($customer->ServiceOrders as $serviceOrder) {
        foreach ($serviceOrder->fil_product_fil_service_order as $detail) {
          $sales += (float) $detail->pso_subtotal;
        }
      }
    }
    return $sales;
  }
}