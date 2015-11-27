@extends('layouts.dashboard')
@section('page_heading','Agenda')
@section('section')
<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-5">
            <div class="full-width-tabs">

                <!-- Modal -->
                <div class="modal fade" id="registryModal" tabindex="-1" role="dialog" aria-labelledby="registryModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="ModalTitle"></h4>
                            </div>
                            <div class="modal-body">
                                {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                                <div class="form-group">
                                    {{ Form::label('comment','Comentario')}}
                                    {{ Form::textArea('comment',null,['class' => 'form-control','id' => 'comment','placeholder' => 'Comentario...'])}}
                                </div>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('aprobate', '1', null, ['class' => '','id' => 'aprobate'])}} ¿Aprobación del cliente?
                                    </label>
                                </div>
                                <div class=text-right>
                                    {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'save()']) }}
                                    {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}                           
                                </div>
                                {{ Form::close() }}                        
                            </div>
                        </div>
                    </div>
                </div>

                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active fill_width"><a href="#outstanding" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Pendientes</a></li>
                    <li role="presentation" class="fill_width"><a href="#overcome" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">En Proceso</a></li>
                    <li role="presentation" class="fill_width"><a href="#full" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Completas</a></li>                   
                    <li role="presentation" class="fill_width"><a href="#finish" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Historial</a></li>
                </ul>                

                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="outstanding" aria-labelledby="home-tab">
                        <br>
                        <table data-toggle="table">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Cliente</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="pendientes">
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="overcome" aria-labelledby="profile-tab">
                        <br>
                        <table data-toggle="table">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Cliente</th>
                                    <th>Fecha de Inicio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="enProceso">
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="full" aria-labelledby="profile-tab">
                        <br>
                        <table data-toggle="table">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Cliente</th>
                                    <th>Fecha de Inicio</th>
                                </tr>
                            </thead>
                            <tbody id="completas">
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="finish" aria-labelledby="profile-tab">
                        <br>
                        <table data-toggle="table">
                            <thead>
                                <tr>
                                    <th>Orden</th>
                                    <th>Cliente</th>
                                    <th>Fecha de Inicio</th>
                                </tr>
                            </thead>
                            <tbody id="historial">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-7">
            <div class="page-header">
                <div class="pull-right form-inline">
                    <div class="btn-group">
                        <button class="btn btn-primary" data-calendar-nav="prev">&lt;&lt; Anterior</button>
                        <button class="btn" data-calendar-nav="today">Hoy</button>
                        <button class="btn btn-primary" data-calendar-nav="next">Siguiente &gt;&gt;</button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning" data-calendar-view="year">Año</button>
                        <button class="btn btn-warning active" data-calendar-view="month">Mes</button>
                        <button class="btn btn-warning" data-calendar-view="week">Semana</button>
                        <button class="btn btn-warning" data-calendar-view="day">Día</button>
                    </div>
                </div>
                <h3>March 2013</h3>
            </div>
            <div id="calendar"></div>
        </div>
        <div class="modal fade" id="events-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3>Eventss</h3>
                    </div>
                    <div class="modal-body" style="height: 400px">
                    </div>
                    <div class="modal-footer">
                        <a href="#" data-dismiss="modal" class="btn">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>       
var getDatesRoute = '{{ action('productionController@getReadDates'); }}';
var getServiceOrdersRoute = '{{ action('productionController@postReadServiceOrder'); }}';
var getDatesByServiceOrderRoute = '{{ action('productionController@postReadDatesByServiceOrder'); }}';
var setToInProcessRoute = '{{ action('productionController@postInProcess'); }}';
var checkRegistryRoute = '{{ action('productionController@postCheckRegistry'); }}';
var setCustomerResponseRoute = '{{ action('productionController@postSaveComment'); }}';
</script>
<script src="{{ asset("assets/scripts/production_ajax.js") }}" type="text/javascript"></script>
@stop
