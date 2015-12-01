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

class homeController extends Controller
{
    public function postLoadChartSales() {
        $serviceOrders = fil_service_order::all();
        $endMonth = date('n');
        $startMonth = $endMonth - 3;
        $currentYear = date('Y');
        $data1 = [];
        $data2 = [];
        $data3 = [];
        foreach ($serviceOrders as $order) {
            $month = date('m', strtotime($order->created_at));
            $year = date('m', strtotime($order->created_at));
            if ($currentYear == $year) {
                if ($month > $startMonth && $month <= $endMonth) {
                    switch ($month) {
                        case $endMonth:
                            $data1[] = (float)$order->ser_outlay;
                            break;

                        case ($endMonth - 1):
                            $data2[] = (float)$order->ser_outlay;
                            break;

                        case ($endMonth - 2):
                            $data3[] = (float)$order->ser_outlay;
                            break;
                    }
                }
            }
        }
        
    }
}
