@extends('layouts.dashboard')
@section('page_heading','Programas')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
                Agregar Programa
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addShow">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Programa</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'sho_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'sho_description','placeholder' => 'descripción'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('media','Medio de transmisión')}}
                                {{ Form::select('media',['null' => '---Seleccionar medio de transmisión---','televisión' => 'Televisión', 'web' => 'Web'],'null',['class' => 'form-control','id' => 'sho_media']) }}
                            </div>
                            <div class=text-right>
                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'create()']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                            </div>
                            {{ Form::close() }}                        
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Update -->
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateShow">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modificar Programa</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'actualizar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'u_sho_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'u_sho_description','placeholder' => 'descripción'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('media','Medio de transmisión')}}
                                {{ Form::select('media',['null' => '---Seleccionar medio de transmisión---','televisión' => 'Televisión', 'web' => 'Web'],'null',['class' => 'form-control','id' => 'u_sho_media']) }}
                            </div>
                            <div class=text-right>
                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'update()']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                            </div>
                            {{ Form::close() }}                        
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-12 table-responsive">
            <table class="table table-striped table-hover table-bordered margin-top20">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>descripción</th>
                        <th>Medio de Transmisión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="unidades_negocio">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var createRoute = '{{ action('showController@postCreate'); }}';
var readRoute = '{{ action('showController@postRead'); }}';
var updateRoute = '{{ action('showController@postUpdate'); }}';
var deleteRoute = '{{ action('showController@postDelete'); }}';
var readAllRoute = '{{ action('showController@postReadAll'); }}';
</script>
<script src="{{ asset("assets/scripts/show_ajax.js") }}" type="text/javascript"></script>

@stop