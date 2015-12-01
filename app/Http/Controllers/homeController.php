<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Routing\Controller;
use App\fil_employee;
use App\fil_service_order;
use App\fil_payment_date;

class homeController extends Controller
{
    public function postLoadChartSales() {
        $serviceOrders = fil_service_order::all();
        $endMonth = (float)date('n');
        $startMonth = $endMonth - 3;
        $currentYear = date('Y');
        $data = [0, 0, 0];
        foreach ($serviceOrders as $order) {
            if (($order->ser_auth_admin == 2) && ($order->ser_auth_production == 2) && ($order->ser_auth_sales == 2)) {
                $month = (float)date('n', strtotime($order->created_at));
                $year = (float)date('Y', strtotime($order->created_at));
                if ($currentYear == $year) {
                    if ($month > $startMonth && $month <= $endMonth) {
                        switch ($month) {
                            case ($endMonth - 2):
                                $data[0]+= (float)$order->ser_outlay;
                                break;

                            case ($endMonth - 1):
                                $data[1]+= (float)$order->ser_outlay;
                                break;

                            case ($endMonth):
                                $data[2]+= (float)$order->ser_outlay;
                                break;
                        }
                    }
                }
            }
        }        
        switch ($endMonth) {
            case 1:
                unset($data[0]);
                unset($data[1]);
                break;

            case 2:
                unset($data[0]);
                break;
        }
        $series = ['name' => 'Ventas', 'data' => $data];
        $categories = null;
        switch ($endMonth) {
            case 1:
                $categories = [date('F', mktime(0, 0, 0, $endMonth, 10)) ];
                break;

            case 2:
                $categories = [date('F', mktime(0, 0, 0, $endMonth - 1, 10)), date('F', mktime(0, 0, 0, $endMonth, 10)) ];
                break;

            default:
                $categories = [date('F', mktime(0, 0, 0, $endMonth - 2, 10)), date('F', mktime(0, 0, 0, $endMonth - 1, 10)), date('F', mktime(0, 0, 0, $endMonth, 10)) ];
                break;
        }
        $response = Response::json(array('success' => true, 'data' => array('chart' => ['renderTo' => 'charts1'], 'credits' => ['enabled' => false], 'title' => ['text' => 'Ventas de los ultimos 3 meses del perido'], 'xAxis' => ['categories' => $categories], 'yAxis' => ['title' => ['text' => 'Monto']], 'tooltip' => ['valueSuffix' => ' Pesos'], 'series' => [$series])));
        return $response;
    }
    
    public function postLoadChartPayments() {
        $paymets = fil_payment_date::all();
        $currentTime = date('n-Y');
        $total = 0;
        $get = 0;
        foreach ($paymets as $payment) {
            if ($currentTime == date('n-Y', strtotime($payment->created_at))) {
                $total+= (float)$payment->pda_amount;
                if ($payment->pda_status == 'pagado') {
                    $get+= (float)$payment->pda_amount;
                }
            }
        }
        $response = Response::json(array('success' => true, 'data' => array('chart' => ['type' => 'bar', 'renderTo' => 'charts2'], 'credits' => ['enabled' => false], 'title' => ['text' => 'Cobranza del Mes'], 'xAxis' => ['categories' => ['Cobranza']], 'yAxis' => ['title' => ['text' => 'Monto']], 'tooltip' => ['valueSuffix' => ' Pesos'], 'series' => [['name' => 'Total', 'data' => [$total]], ['name' => 'Cobrado', 'data' => [$get]]])));
        return $response;
    }
    
    public function postGetSalesByEmployee() {
        $employees = fil_employee::all();
        $data = [];
        foreach ($employees as $employee) {
            if ($employee->emp_job == 'vendedor') {
                $sales = 0;
                foreach ($employee->customers as $customer) {
                    foreach ($customer->serviceOrders as $order) {
                        if (date('n-Y') == date('n-Y', strtotime($order->created_at))) {
                            $sales+= (float)$order->ser_outlay;
                        }
                    }
                }
                $data[] = ['name' => $employee->emp_first_name . ' ' . $employee->emp_last_name, 'y' => $sales];
            }
        }
        $response = Response::json(array('success' => true, 'data' => ['chart' => ['plotBackgroundColor' => null, 'plotBorderWidth' => null, 'plotShadow' => false, 'type' => 'pie', 'renderTo' => 'charts3'], 'credits' => ['enabled' => false], 'title' => ['text' => 'Porcentaje de ventas por vendedor en el mes'], 'tooltip' => ['pointFormat' => '{series.name}: <b>{point.percentage:.1f}%</b>'], 'plotOptions' => ['pie' => ['allowPointSelect' => true, 'cursor' => 'pointer', 'dataLabels' => ['enabled' => true, 'format' => '<b>{point.name}</b>: {point.percentage:.1f} %', 'style' => ['color' => "(Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'"]]]], 'series' => [['name' => "Ventas", 'colorByPoint' => true, 'data' => $data]]]));
        return $response;
    }
}
