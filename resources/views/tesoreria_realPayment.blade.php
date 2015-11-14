@extends('layouts.dashboard')
@section('page_heading','Pagos de la Orden de Servicio: '.$ser_id)
@section('section')
<div class="col-sm-12">
    <div class="row"> 
        <div class="col-lg-9" {{ ($hasIVA) ? '' : 'style="display:none"' }} >    
            <h4><b>Importante este pago requiere factura</b></h4>
        </div>
        <div class="col-lg-3">    
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add" id="buttonPay">
                Agregar Pago
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addCustomer">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Agregar Pago</h4>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                        <div class="form-group">
                            {{ Form::label('amount','Cantidad')}}
                            {{ Form::number('amount',null,['class' => 'form-control','id' => 'rpa_amount','placeholder' => 'Cantidad'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('method','Método de Pago')}}
                            {{ Form::select('method', ['contado'=>'contado','cheque'=>'cheque','transferencia bancaria'=>'transferencia bancaria','tarjeta'=>'tarjeta'] ,'contado', ['class' => 'form-control','id'=>'rpa_method','onchange' => 'checkForAccount()']) }}
                        </div>
                        <div class="form-group" id="account" style="display:none">
                            {{ Form::label('account','Cuenta de pago (ultimos 4 digitos)')}}
                            {{ Form::number('account',null,['class' => 'form-control','id' => 'rpa_account','placeholder' => 'Cuenta de Pago'])}}
                        </div>                        
                        <div class="checkbox">
                            <label>
                                {{ Form::checkbox('has_invoice', '2', null, ['class' => '','id' => 'rpa_has_invoice'])}} ¿Tiene Factura?
                            </label>
                        </div>
                        <div id="hasInvoice" style="display:none">
                            <div class="form-group">
                                {{ Form::label('invoice_data','Factura')}}
                                {{ Form::select('invoice_data', ['nueva'=>'---Nueva Factura---'] ,'nueva', ['class' => 'form-control','id'=>'rpa_fk_invoice_data','onchange' => 'checkForInvoice()']) }}
                            </div>
                            <div class="form-group" id="invoice" style="display:bloc">
                                {{ Form::label('invoice','CFDI de la Nueva Factura')}}
                                {{ Form::text('invoice',null,['class' => 'form-control','id' => 'ind_cfdi','placeholder' => 'CFDI'])}}
                            </div>
                        </div>
                        <div class=text-right>
                            {{ Form::button('Guardar',['class' => 'btn btn-success','onclick' => 'sendPayment()']) }}
                            {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                        </div>                        
                        {{ Form::close() }}                        
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12">    
            <h3><b>Datos del Cliente</b></h3> 
            <hr>
            <div id="datos_fiscales" class="col-lg-6">
                {{ $clienteColum1 }}
            </div>
            <div id="datos_fiscales" class="col-lg-6">
                {{ $clienteColum2 }}
            </div>
        </div>
        <div class="col-lg-12">     
            <div id="datos_fiscales" class="col-lg-7">
                <h3><b>Pagos</b></h3> 
                <hr>
                <table class="table table-striped table-hover table-bordered margin-top20">
                    <thead>
                        <tr>
                            <th>ID Unico</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Método</th>
                            <th>Cuenta</th>
                        </tr>
                    </thead>
                    <tbody id="realPayment">
                    </tbody>                    
                </table>
                <div class="col-lg-7">
                </div>
                <div class="col-lg-5">
                    <table class="table table-striped table-hover table-bordered margin-top20" align="right">
                        <thead>
                            <tr>
                                <th>Total Pago</th>
                                <th>Pagado</th>
                                <th>Pendiente</th>
                            </tr>
                        </thead>
                        <tbody id="totals">
                        </tbody>                    
                    </table>
                </div>
            </div>                
            <div id="datos_fiscales" class="col-lg-5">
                <h3><b>Facturas Asociadas</b></h3> 
                <hr>
                <table class="table table-striped table-hover table-bordered margin-top20">
                    <thead>
                        <tr>
                            <th>CFDI de la Factura</th>                            
                        </tr>
                    </thead>
                    <tbody id="cfdis">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
    var payment = {{ $payment }};
    var readCFDISRoute = '{{ action('treasuryController@postReadCFDIS'); }}';
    var sendPaymentRoute = '{{ action('treasuryController@postCreateRealPayment'); }}';
</script>
<script src="{{ asset("assets/scripts/treasury_payment_ajax.js") }}" type="text/javascript"></script>

@stop
