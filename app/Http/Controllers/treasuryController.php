<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use App\fil_payment_date;
use App\fil_service_order;
use App\fil_invoice_data;
use App\fil_real_payment;

class treasuryController extends Controller
{
    public function postReadPayments() {
        $payments = fil_payment_date::orderBy('pda_date', 'asc')->get();
        if ($payments == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los pagos'));
        }
        $outstanding = [];
        $full = [];
        $late = [];
        $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime($today));
        foreach ($payments as $value) {
            if (($value->paymentScheme->serviceOrder->ser_auth_admin == 2) && ($value->paymentScheme->serviceOrder->ser_auth_production == 2) && ($value->paymentScheme->serviceOrder->ser_auth_sales == 2)) {
                $value->paymentScheme->serviceOrder->customer;
                if ($value->pda_status == 'facturado') {
                    $paymentsTotal = 0;
                    foreach ($value->realPayments as $payment) {
                        $paymentsTotal = $paymentsTotal + (float)$payment->rpa_amount;
                    }
                    $value->pda_outstanding = ((float)$value->pda_amount) - $paymentsTotal;
                    if (($today <= date('Y-m-d', strtotime($value->pda_date)))) {
                        $outstanding[] = $value;
                    } 
                    else {
                        $late[] = $value;
                    }
                } 
                else {
                    if ($value->pda_status == 'pagado') {
                        $full[] = $value;
                    }
                }
            }
        }
        $response = Response::json(array('success' => true, 'outstanding' => $outstanding, 'full' => $full, 'late' => $late,));
        return $response;
    }
    
    public function postReadServiceOrder() {
        $serviceOrder = fil_service_order::orderBy('ser_id', 'desc')->get();
        if ($serviceOrder == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer la ordenes de servicio'));
        }
        $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime($today));
        $activeServiceOrder = [];
        $historyServiceOrder = [];
        foreach ($serviceOrder as $value) {
            $value->customer;
            if (($value->ser_auth_admin == 2) && ($value->ser_auth_production == 2) && ($value->ser_auth_sales == 2)) {
                if (($today <= date('Y-m-d', strtotime($value->ser_end_date)))) {
                    $activeServiceOrder[] = $value;
                } 
                else {
                    $historyServiceOrder[] = $value;
                }
            }
        }
        $response = Response::json(array('success' => true, 'activeServiceOrder' => $activeServiceOrder, 'historyServiceOrder' => $historyServiceOrder));
        return $response;
    }
    
    public function readPayments($id) {
        $payments = fil_service_order::find($id)->paymentScheme->paymentDates;
        if ($payments == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los pagos'));
        }
        $outstanding = [];
        $full = [];
        $late = [];
        $today = date('Y-m-d');
        $today = date('Y-m-d', strtotime($today));
        foreach ($payments as $value) {
            if (($value->paymentScheme->serviceOrder->ser_auth_admin == 2) && ($value->paymentScheme->serviceOrder->ser_auth_production == 2) && ($value->paymentScheme->serviceOrder->ser_auth_sales == 2)) {
                if ($value->pda_status == 'facturado') {
                    $paymentsTotal = 0;
                    foreach ($value->realPayments as $payment) {
                        $paymentsTotal = $paymentsTotal + (float)$payment->rpa_amount;
                    }
                    $value->paymentScheme->serviceOrder->customer;
                    $value->pda_outstanding = ((float)$value->pda_amount) - $paymentsTotal;
                    if (($today <= date('Y-m-d', strtotime($value->pda_date)))) {
                        $outstanding[] = $value;
                    } 
                    else {
                        $late[] = $value;
                    }
                } 
                else {
                    if ($value->pda_status == 'pagado') {
                        $full[] = $value;
                    }
                }
            }
        }
        $customer = fil_service_order::find($id)->customer->cus_contact_first_name . ' ' . fil_service_order::find($id)->customer->cus_contact_last_name;
        $commercialName = fil_service_order::find($id)->customer->cus_commercial_name;
        $data = array('outstanding' => json_encode($outstanding), 'full' => json_encode($full), 'late' => json_encode($late), 'header' => $id, 'customer' => $customer, 'commercialName' => $commercialName);
        return view('tesoreria_orden_de_servicio', $data);
    }
    
    public function detailPayment($id) {
        $payment = fil_payment_date::find($id);
        if ($payment == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer el pago'));
        }
        $payment->realPayments;
        $serviceOrder = fil_payment_date::find($id)->paymentScheme->serviceOrder;
        $hasIVA = false;
        if ($serviceOrder->ser_iva != 0) {
            $hasIVA = true;
        }
        $fiscal = $serviceOrder->customer->taxData;
        $clienteColum1 = '<b>RFC: </b>' . $fiscal->tax_rfc . '<br><b>Razón Social: </b>' . $fiscal->tax_business_name . '<br><b>Calle: </b>' . $fiscal->tax_street . '<br><b>Número Exterior: </b>' . $fiscal->tax_outdoor_number . '<br><b>Número Interior: </b>' . $fiscal->tax_apartment_number . '<br><b>Colonia: </b>' . $fiscal->tax_colony . '<br><b>Código Postal: </b>' . $fiscal->tax_postal_code;
        $clienteColum2 = '<br><b>Municipio: </b>' . $fiscal->tax_town . '<br><b>Localidad: </b>' . $fiscal->tax_locality . '<br><b>Estado: </b>' . $fiscal->tax_state . '<br><b>País: </b>' . $fiscal->tax_country . '<br><b>Email Fiscal: </b>' . $fiscal->tax_tax_email . '<br><b>Representante Legal: </b>' . $fiscal->tax_legal_representative;
        $data = array('clienteColum1' => $clienteColum1, 'clienteColum2' => $clienteColum2, 'ser_id' => $serviceOrder->ser_id, 'hasIVA' => $hasIVA, 'payment' => json_encode($payment));
        return view('tesoreria_realPayment', $data);
    }
    
    public function postReadCFDIS() {
        $invoices = fil_invoice_data::all();
        $response = Response::json(array('success' => true, 'data' => $invoices));
        return $response;
    }
    
    public function postCreateRealPayment() {
        $values = Request::all();
        if ($values['rpa_amount'] == '' || $values['rpa_amount'] == null) {
            return Response::json(array('success' => false, 'data' => 'Campo monto requerido'));
        }
        $realPayment = new fil_real_payment;
        $realPayment->rpa_fk_payment_date = $values['rpa_fk_payment_date'];
        $realPayment->rpa_amount = $values['rpa_amount'];
        $realPayment->rpa_date = date('Y-m-d');
        if ($values['rpa_method'] == 'contado') {
            $realPayment->rpa_method = $values['rpa_method'];
            $realPayment->rpa_account = '';
        } 
        else {
            if ($values['rpa_account'] == '' || $values['rpa_account'] == null) {
                return Response::json(array('success' => false, 'data' => 'Campo cuenta requerido'));
            }
            $realPayment->rpa_method = $values['rpa_method'];
            $realPayment->rpa_account = $values['rpa_account'];
        }
        
        if (!$realPayment->save()) {
            return Response::json(array('success' => false, 'data' => 'Error al guardar el pago'));
        }
        $this->checkForStatus($values['rpa_fk_payment_date']);
        
        $response = Response::json(array('success' => true, 'data' => 'Pago guardado con exito'));
        return $response;
    }
    
    function convertToTinyint($value) {
        if ($value == 'true') {
            return 1;
        } 
        else {
            return 0;
        }
    }
    
    function convertToBolean($value) {
        if ($value == 'true') {
            return true;
        } 
        else {
            return false;
        }
    }
    
    function checkForStatus($id) {
        $value = fil_payment_date::find($id);
        if ($value == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer el pago'));
        }
        $paymentsTotal = 0;
        foreach ($value->realPayments as $payment) {
            $paymentsTotal = $paymentsTotal + (float)$payment->rpa_amount;
        }
        if ($paymentsTotal == $value->pda_amount) {
            $value->pda_status = 'pagado';
            if (!$value->save()) {
                return Response::json(array('success' => false, 'data' => 'Error al guardar el pago'));
            }
        }
    }
    
    public function postReadPaymentsToInvoice() {
        $payments = fil_payment_date::orderBy('pda_date', 'asc')->get();
        if ($payments == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer los pagos'));
        }
        $invoice = [];
        $recipt = [];
        foreach ($payments as $value) {
            if (($value->paymentScheme->serviceOrder->ser_auth_admin == 2) && ($value->paymentScheme->serviceOrder->ser_auth_production == 2) && ($value->paymentScheme->serviceOrder->ser_auth_sales == 2)) {
                if ($value->pda_status == 'pendiente') {
                    $value->paymentScheme->serviceOrder->customer;
                    if ($value->paymentScheme->serviceOrder->ser_iva == 0) {
                        $recipt[] = $value;
                    } 
                    else {
                        $invoice[] = $value;
                    }
                }
            }
        }
        $response = Response::json(array('success' => true, 'invoice' => $invoice, 'recipt' => $recipt));
        return $response;
    }
    
    public function postSaveInvoice() {
        $payment = fil_payment_date::find(Request::get('id'));
        if ($payment == null) {
            return Response::json(array('success' => false, 'data' => 'Error al leer el pago'));
        }
        $invoice = new fil_invoice_data;
        $invoice->ind_id = $payment->pda_id;
        $invoice->ind_cfdi = Request::get('content');
        if (!$invoice->save()) {
            return Response::json(array('success' => false, 'data' => 'Error al guardar la factura'));
        }
        $payment->pda_status = 'facturado';
        if (!$payment->save()) {
            return Response::json(array('success' => false, 'data' => 'Error al guardar el pago'));
        }
        $response = Response::json(array('success' => true, 'data' => 'Factura guardada con exito'));
        return $response;
    }
}
