@extends('layouts.dashboard')
@section('page_heading','Pagos de la Orden de Servicio: '.$header.' Cliente: '.$customer.', Empresa: '.$commercialName)
@section('section')
<div class="col-sm-12">
    <div class="row"> 

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
                            {{ Form::label('method','Método de Pago')}}
                            {{ Form::select('method', ['contado'=>'contado','cheque'=>'cheque','transferencia bancaria'=>'transferencia bancaria','tarjeta'=>'tarjeta'] ,'contado', ['class' => 'form-control','id'=>'rpa_method','onchange' => 'checkForAccount()']) }}
                        </div>
                        <div class="form-group" id="account" style="display:none">
                            {{ Form::label('account','Cuenta de pago (ultimos 4 digitos)')}}
                            {{ Form::number('account',null,['class' => 'form-control','id' => 'rpa_account','placeholder' => 'Cuenta de Pago'])}}
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
            <div class="full-width-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active fill_width"><a href="#outstanding" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Pagos Pendientes</a></li>
                    <li role="presentation" class="fill_width"><a href="#overcome" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Pagos Vencidos</a></li>
                    <li role="presentation" class="fill_width"><a href="#full" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Pagos Competos</a></li>                    
                </ul>                

                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="outstanding" aria-labelledby="home-tab">
                       <div class="col-lg-12">
                        <h3><b>Pagos Pendientes</b></h3> 
                        <hr>
                        <table class="table table-striped table-hover table-bordered margin-top20">
                            <thead>
                                <tr>
                                    <th>Monto</th>
                                    <th>Fecha</th>
                                    <th>Orden de Servicio</th>
                                    <th>Acciones</th>                      
                                </tr>
                            </thead>
                            <tbody id="pendientes">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="overcome" aria-labelledby="profile-tab">
                    <div class="col-lg-12">
                        <h3><b>Pagos Vencidos</b></h3> 
                        <hr>
                        <table class="table table-striped table-hover table-bordered margin-top20">
                            <thead>
                                <tr>
                                 <th>Monto</th>
                                 <th>Fecha</th>
                                 <th>Orden de Servicio</th>
                                 <th>Cliente</th>
                                 <th>Acciones</th>          
                             </tr>
                         </thead>
                         <tbody id="vencidos">

                         </tbody>                        
                     </table>
                 </div>
             </div>
             <div role="tabpanel" class="tab-pane fade" id="full" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <h3><b>Pagos Completados</b></h3> 
                    <hr>
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Orden de Servicio</th>
                            </tr>
                        </thead>
                        <tbody id="completados">

                        </tbody>                        
                    </table>
                </div>
            </div>                
        </div>
    </div>
</div>
</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>       
var full = {{ $full  }};
var outstanding = {{ $outstanding }};
var late = {{ $late }};
var paymentsServiceOrderRoute = '{{ route('tesoreria'); }}';
var sendPaymentRoute = '{{ action('treasuryController@postCreateRealPayment'); }}';
</script>
<script src="{{ asset("assets/scripts/treasury_order_ajax.js") }}" type="text/javascript"></script>

@stop
