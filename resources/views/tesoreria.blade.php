@extends('layouts.dashboard')
@section('page_heading','Pagos')
@section('section')
<div class="col-sm-12">
    <div class="row">                
        <div class="col-lg-12">    
            <div class="full-width-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active fill_width"><a href="#outstanding" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Pagos Pendientes</a></li>
                    <li role="presentation" class="fill_width"><a href="#overcome" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Pagos Vencidos</a></li>
                    <li role="presentation" class="fill_width"><a href="#full" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Pagos Completos</a></li>
                    <li role="presentation" class="fill_width"><a href="#serviceOrderActive" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Pagos por Orden de Servicio Vigentes</a></li>
                    <li role="presentation" class="fill_width"><a href="#serviceOrderHistory" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Pagos por Orden de Servicio Anteriores</a></li>
                </ul>                

                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="outstanding" aria-labelledby="home-tab">
                     <div class="col-lg-12">
                        <h3><b>Pagos Pendientes</b></h3> 
                        <hr>
                        <table class="table table-striped table-hover table-bordered margin-top20">
                            <thead>
                                <tr>
                                    <th>Monto Total</th>
                                    <th>Monto Pendiente</th>
                                    <th>Fecha</th>
                                    <th>Orden de Servicio</th>
                                    <th>Cliente</th>
                                    <th>ver Detalles</th>                      
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
                                   <th>Monto Total</th>
                                   <th>Monto Pendiente</th>
                                   <th>Fecha</th>
                                   <th>Orden de Servicio</th>
                                   <th>Cliente</th>
                                   <th>ver Detalles</th>          
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
                                <th>Cliente</th>
                                <th>Ver Detalles</th>
                            </tr>
                        </thead>
                        <tbody id="completados">

                        </tbody>                        
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="serviceOrderActive" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <h3><b>Ordenes de Servicio Vigentes</b></h3> 
                    <hr>
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Termino</th>
                                <th>Ver Pagos</th>                                        
                            </tr>
                        </thead>
                        <tbody id="vigentes">

                        </tbody>
                    </table> 
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="serviceOrderHistory" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <h3><b>Ordenes de Servicio Anteriores</b></h3> 
                    <hr>
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Termino</th>
                                <th>Ver Pagos</th>                                        
                            </tr>
                        </thead>
                        <tbody id="anteriores">

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
    var readPaymentsRoute = '{{ action('treasuryController@postReadPayments'); }}';
    var readServiceOrderRoute = '{{ action('treasuryController@postReadServiceOrder'); }}';
    var paymentsServiceOrderRoute = '{{ route('tesoreria'); }}';
</script>
<script src="{{ asset("assets/scripts/treasury_ajax.js") }}" type="text/javascript"></script>

@stop
