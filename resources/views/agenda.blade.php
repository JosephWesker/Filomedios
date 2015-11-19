@extends('layouts.dashboard')
@section('page_heading','Agenda')
@section('section')
<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-4">
            <table data-toggle="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Fecha de Inicio</th>
                    </tr>
                </thead>
                <tbody id="serviceOrders">
                </tbody>
            </table>
        </div>
        <div class="col-lg-8">
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
</script>
<script src="{{ asset("assets/scripts/production_ajax.js") }}" type="text/javascript"></script>
@stop
