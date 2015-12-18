@extends('layouts.dashboard')
@section('page_heading','Videos')
@section('section')
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
                    {{ Form::label('name','Nombre')}}
                    {{ Form::text('name',null,['class' => 'form-control','id' => 'vid_name','placeholder' => 'Nombre'])}}
                </div>
                <div class="form-group">
                    {{ Form::label('type','Tipo de video')}}
                    {{ Form::select('type', ['producción'=>'Producción','relleno'=>'Relleno'] ,null, ['class' => 'form-control','id'=>'vid_type', 'onchange' => 'setServiceOrderDisabled()']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('service_order','Orden de Servicio')}}
                    {{ Form::select('service_order', ['null'=>'Varias'] ,null, ['class' => 'form-control','id'=>'vid_service_order']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('type_impacts','Tipo de Impactos')}}
                    {{ Form::select('type_impacts', ['por hora'=>'Por hora','por día'=>'Por día'] ,null, ['class' => 'form-control','id'=>'vid_type_impacts']) }}
                </div>	
                <div class="form-group">
                    {{ Form::label('impacts','Impactos')}}
                    {{ Form::number('impacts',null,['class' => 'form-control','id' => 'vid_impacts','min' => '1' ,'placeholder' => 'Impactos'])}}
                </div>
                <div class="form-group col-lg-6">
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="date" id="vid_start_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"/>
                </div>
                <div class="form-group col-lg-6">
                    <label for="end_date">Fecha de Termino</label>
                    <input type="date" id="vid_end_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Termino"/>
                </div>
                <div class="form-group">
                    {{ Form::label('days','Dias de Transmisión')}}
                    <div class="checkbox">
	                   	<label>
	                        {{ Form::checkbox('all', '1', null, ['id' => 'day_all', 'onclick' => 'setallselect($(this))'])}} Todos
	                    </label>
                    </div>
                    <div class="checkbox">
	                   	<label>
	                        {{ Form::checkbox('monday', '1', null, ['id' => 'day_monday', 'class' => 'day_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Lunes
	                    </label>
	                    <label>
	                        {{ Form::checkbox('tuesday', '1', null, ['id' => 'day_tuesday', 'class' => 'day_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Martes
	                    </label>
	                    <label>
	                        {{ Form::checkbox('wednesday', '1', null, ['id' => 'day_wednesday', 'class' => 'day_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Miercoles
	                    </label>
	                    <label>
	                        {{ Form::checkbox('thursday', '1', null, ['id' => 'day_thursday', 'class' => 'day_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Jueves
	                    </label>
	                    <label>
	                        {{ Form::checkbox('friday', '1', null, ['id' => 'day_friday', 'class' => 'day_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Viernes
	                    </label>
	                    <label>
	                        {{ Form::checkbox('saturday', '1', null, ['id' => 'day_saturday', 'class' => 'day_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Sabado
	                    </label>
	                    <label>
	                        {{ Form::checkbox('sunday', '1', null, ['id' => 'day_sunday', 'class' => 'day_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Domingo
	                    </label>
                    </div>
                </div>
                <div class="form-group">
                    {{ Form::label('schedule','Horario')}}
                    <div class="checkbox">
	                   	<label>
	                        {{ Form::checkbox('all', '1', null, ['id' => 'sch_all', 'onclick' => 'setallselect($(this))'])}} Todos
	                    </label>
                    </div>
                    <div class="checkbox">
	                   	<label>
	                        {{ Form::checkbox('one', '1', null, ['id' => 'sch_one', 'class' => 'sch_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Uno
	                    </label>
	                    <label>
	                        {{ Form::checkbox('two', '1', null, ['id' => 'sch_two', 'class' => 'sch_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Dos
	                    </label>
	                    <label>
	                        {{ Form::checkbox('three', '1', null, ['id' => 'sch_three', 'class' => 'sch_all', 'onclick' => 'setDisabledAll($(this).attr(\'class\'))'])}} Tres
	                    </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="file">Archivo</label>
                    <input type="file" class="form-control" id="file">
                </div>
                <div class=text-right>
                    {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'sendFile()']) }}
                    {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
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
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>       

</script>
<script src="{{ asset("assets/scripts/videos_ajax.js") }}" type="text/javascript"></script>      
@stop
