@extends('layouts.dashboard') @section('page_heading','Videos') @section('section')
<div class="col-lg-12">
    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
        Cargar video
    </button>
    <!-- Modal -->
    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addBusinessUnit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cargar video</h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => '#', 'id' => 'agregar', 'enctype' => 'multipart/form-data')) }}
                    <div class="form-group">
                        {{ Form::label('name','Nombre')}} {{ Form::text('name',null,['class' => 'form-control','id' => 'vid_name','placeholder' =>
                        'Nombre'])}}
                    </div>
                    <div class="form-group">
                        {{ Form::label('service_order','Orden de Servicio')}} {{ Form::select('service_order', ['null' => '---Varias ordenes---'] ,null, ['class' => 'form-control','id'=>'vid_service_order','onchange' => 'disableDetail()']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('type','Tipo de Video')}} {{ Form::select('type', ['programación' => 'Programación','Comercial' => 'Video Comercial'] ,null, ['class' => 'form-control','id'=>'vid_type','onchange' => 'loadDetails()']) }}
                    </div>
                    <div class="form-group" id="unique" style="display:none">
                        {{ Form::label('detail_product','Producto')}} {{ Form::select('detail_product', [] ,null, ['class' => 'form-control','id'=>'vid_detail_product','disabled']) }}
                    </div>
                    <div id="dates">
                        <div class="form-group">
                            <label for="start_date">Fecha de Inicio</label>
                            <input type="date" id="vid_start_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"/>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Fecha de Termino</label>
                            <input type="date" id="vid_end_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Termino"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file">Archivo</label>
                        <input type="file" class="form-control" id="file">
                    </div>
                    <div class=text-right>
                        {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'sendFile()']) }} {{ Form::button('Cancelar',['class'
                        => 'btn btn-danger','data-dismiss' => 'modal']) }}
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12">
    <h3><b>Videos Cargados</b></h3>
    <hr>
    <table class="table table-striped table-hover table-bordered margin-top20">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Orden de Servicio</th>
                <th>Detalles</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="filesoncloud">

        </tbody>
    </table>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js ") }}" type="text/javascript"></script>
<script>
    var serviceOrdersRoute = '{{ action('serviceOrderController@postReadServiceOrder'); }}';
    var detailsRoute = '{{ action('serviceOrderController@postReadDetails'); }}';
    var sendFileRoute = '{{ action('videoController@postUploadVideo'); }}';
    var readAllRoute = '{{ action('videoController@postReadAll'); }}';
    var deleteRoute = '{{ action('videoController@postDelete'); }}';
</script>
<script src="{{ asset("assets/scripts/videos_ajax.js ") }}" type="text/javascript"></script>
@stop