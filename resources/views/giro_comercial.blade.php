@extends('layouts.dashboard')
@section('page_heading','Giros Comerciales')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
                Agregar Giro Comercial
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addBusinessActivity">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Giro Comercial</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'act_name','placeholder' => 'Nombre'])}}
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
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateBusinessActivity">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modificar Giro Comercial</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'actualizar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'u_act_name','placeholder' => 'Nombre'])}}
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="giro_comercial">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var createRoute = '{{ action('businessActivityController@postCreate'); }}';
var readRoute = '{{ action('businessActivityController@postRead'); }}';
var updateRoute = '{{ action('businessActivityController@postUpdate'); }}';
var deleteRoute = '{{ action('businessActivityController@postDelete'); }}';
var readAllRoute = '{{ action('businessActivityController@postReadAll'); }}';
</script>
<script src="{{ asset("assets/scripts/businessActivity_ajax.js") }}" type="text/javascript"></script>

@stop