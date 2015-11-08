@extends('layouts.dashboard')
@section('page_heading','Gestor de Ordenes de Servicio')
@section('section')
<link href="{{ asset("assets/stylesheets/gestor_de_ordenes_de_servicio.css") }}" rel="stylesheet">

<div class="col-sm-12">
    <div class="row">

        <!-- Modal Show -->                                            
        <div class="modal fade" id="viewComment" tabindex="-1" role="dialog" aria-labelledby="viewComment">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="comentarios_titulo"></h4>
                    </div>
                    <div class="modal-body">
                        <div id="comentarios">
                        </div>                        
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
                                        <th>Detalles</th>
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
                                        <th>Detalles</th>
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
    var ReadServiceOrderSellerRoute = '{{ action('serviceOrderController@postReadServiceOrderSeller'); }}';    
    var serviceOrderViewRoute = '{{ route('gestor de ordenes de servicios'); }}';
    var CommentsRoute = '{{ action('serviceOrderController@postReadComments'); }}';
    </script>
    <script src="{{ asset("assets/scripts/orderManagerSeller_ajax.js") }}" type="text/javascript"></script>

@stop
