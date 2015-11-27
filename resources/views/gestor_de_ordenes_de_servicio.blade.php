@extends('layouts.dashboard')
@section('page_heading','Gestor de Ordenes de Servicio')
@section('section')
<link href="{{ asset("assets/stylesheets/gestor_de_ordenes_de_servicio.css") }}" rel="stylesheet">

<div class="col-sm-12">
    <div class="row">

        <!-- Modal Show -->                                            
        <div class="modal fade" id="setComment" tabindex="-1" role="dialog" aria-labelledby="setComment">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Comentario</h4>
                    </div>
                    <div class="modal-body">
                        {{ Form::open(array('url' => '#', 'id' => 'enviarComentario')) }} 
                        <div class="form-group">
                            {{ Form::label('comment','Comentario')}}
                            {{ Form::textarea('comment',null,['class' => 'form-control','id'=>'comment']) }}
                        </div>                                                            
                        <div class=text-right>
                            {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'sendReject()']) }}
                            {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                        </div>
                        {{ Form::close() }}                        
                    </div>
                </div>
            </div>
        </div>
        <!--End Modal-->
        
        <div class="col-lg-12">    
            <div class="full-width-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active fill_width"><a href="#accepted" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Autorizadas</a></li>
                    <li role="presentation" class="fill_width"><a href="#pending" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Pendientes de Autorizar</a></li>
                    <li role="presentation" class="fill_width"><a href="#rejected" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Rechazadas</a></li>
                    <li role="presentation" class="fill_width"><a href="#canceled" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Canceladas</a></li>
                    <li role="presentation" class="fill_width"><a href="#history" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Historial</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="accepted" aria-labelledby="home-tab">
                        <div class="col-lg-12">    
                           <table class="table table-striped table-hover table-bordered margin-top20">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="autorizadas">

                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pending" aria-labelledby="profile-tab">
                        <div class="col-lg-12">    
                           <table class="table table-striped table-hover table-bordered margin-top20">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="pendientes">

                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="rejected" aria-labelledby="profile-tab">
                        <div class="col-lg-12">    
                           <table class="table table-striped table-hover table-bordered margin-top20">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody id="rechazadas">

                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="canceled" aria-labelledby="profile-tab">
                        <div class="col-lg-12">    
                           <table class="table table-striped table-hover table-bordered margin-top20">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>                                        
                                    </tr>
                                </thead>
                                <tbody id="canceladas">

                                </tbody>
                            </table> 
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="history" aria-labelledby="profile-tab">
                        <div class="col-lg-12">    
                           <table class="table table-striped table-hover table-bordered margin-top20">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>                                        
                                    </tr>
                                </thead>
                                <tbody id="historial">

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
    var ReadServiceOrderAuthRoute = '{{ action('serviceOrderController@postReadServiceOrderAuth'); }}';
    var AuthOrderRoute = '{{ action('serviceOrderController@postAuthOrder'); }}';
    var RejectOrderRoute = '{{ action('serviceOrderController@postRejectOrder'); }}';
    var CancelOrderRoute = '{{ action('serviceOrderController@postCancelOrder'); }}';
    var serviceOrderViewRoute = '{{ route('gestor de ordenes de servicios'); }}';
    </script>
    <script src="{{ asset("assets/scripts/orderManager_ajax.js") }}" type="text/javascript"></script>

@stop
