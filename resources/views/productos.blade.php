@extends('layouts.dashboard')
@section('page_heading','Productos')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
                Agregar Producto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addProducts">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Producto</h4>
                        </div>
                        <div class="modal-body">
                                {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'pro_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('type','Tipo')}}
                                {{ Form::select('type',['null' => '---Seleccionar tipo---','individual' => 'Producto individual', 'compuesto' => 'Producto compuesto', 'web' => 'Producto en sitio o medio web', 'produccion' => 'Producción'],'null',['class' => 'form-control','id' => 'pro_type'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','Descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'pro_description','placeholder' => 'Descripción'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('has_show','¿Pertenece a un Programa?')}}
                                <br>
                                {{ Form::radio('has_show','1',false) }} Si
                                {{ Form::radio('has_show','0',true) }} No
                            </div>
                            <div class="form-group">
                                {{ Form::label('has_schema','¿Debe tener un esquema de transmisión?')}}
                                <br>
                                {{ Form::radio('has_schema','1',true) }} Si
                                {{ Form::radio('has_schema','0',false) }} No
                            </div>
                            <div class="form-group">
                                {{ Form::label('has_production_registry','¿Debe tener un registro de producción?')}}
                                <br>
                                {{ Form::radio('has_production_registry','1',true) }} Si
                                {{ Form::radio('has_production_registry','0',false) }} No
                            </div>
                            <div class="form-group">
                                {{ Form::label('duration_type','Tipo de Duración')}}
                                {{ Form::select('duration_type',['segundos' => 'Segundos','dias' => 'Días'],'segundos',['class' => 'form-control','id' => 'pro_duration_type'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('duration','Duración')}}
                                {{ Form::number('duration',null,['class' => 'form-control','id' => 'pro_duration','placeholder' => '0.00', 'step' => '1']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('daily_impacts','Impactos Diarios')}}
                                {{ Form::number('daily_impacts',null,['class' => 'form-control','id' => 'pro_daily_impacts','placeholder' => '0.00', 'step' => '1']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('outlay','Inversión')}}
                                {{ Form::number('outlay',null,['class' => 'form-control','id' => 'pro_outlay','placeholder' => '0.00', 'step' => '0.50']) }}
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
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateProducts">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modificar Producto</h4>
                        <div class="modal-body">
                                {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'u_pro_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('type','Tipo')}}
                                {{ Form::select('type',['null' => '---Seleccionar tipo---','individual' => 'Producto individual', 'compuesto' => 'Producto compuesto', 'web' => 'Producto en sitio o medio web', 'produccion' => 'Producción'],'null',['class' => 'form-control','id' => 'u_pro_type'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','Descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'u_pro_description','placeholder' => 'Descripción'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('has_show','¿Pertenece a un Programa?')}}
                                <br>
                                {{ Form::radio('u_has_show','1',false) }} Si
                                {{ Form::radio('u_has_show','0',true) }} No
                            </div>
                            <div class="form-group">
                                {{ Form::label('has_schema','¿Debe tener un esquema de transmisión?')}}
                                <br>
                                {{ Form::radio('u_has_schema','1',true) }} Si
                                {{ Form::radio('u_has_schema','0',false) }} No
                            </div>
                            <div class="form-group">
                                {{ Form::label('has_production_registry','¿Debe tener un registro de producción?')}}
                                <br>
                                {{ Form::radio('u_has_production_registry','1',true) }} Si
                                {{ Form::radio('u_has_production_registry','0',false) }} No
                            </div>
                            <div class="form-group">
                                {{ Form::label('duration_type','Tipo de Duración')}}
                                {{ Form::select('duration_type',['segundos' => 'Segundos','dias' => 'Días'],'segundos',['class' => 'form-control','id' => 'u_pro_duration_type'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('duration','Duración')}}
                                {{ Form::number('duration',null,['class' => 'form-control','id' => 'u_pro_duration','placeholder' => '0.00', 'step' => '1']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('daily_impacts','Impactos Diarios')}}
                                {{ Form::number('daily_impacts',null,['class' => 'form-control','id' => 'u_pro_daily_impacts','placeholder' => '0.00', 'step' => '1']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('outlay','Inversión')}}
                                {{ Form::number('outlay',null,['class' => 'form-control','id' => 'u_pro_outlay','placeholder' => '0.00', 'step' => '0.50']) }}
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
                        <th>Tipo</th>
                        <th>Descripción</th>                        
                        <th>Duración</th>
                        <th>Impactos Diarios</th>
                        <th>Inversión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="productos">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var createRoute = '{{ action('productController@postCreate'); }}';
var readRoute = '{{ action('productController@postRead'); }}';
var updateRoute = '{{ action('productController@postUpdate'); }}';
var deleteRoute = '{{ action('productController@postDelete'); }}';
var readAllRoute = '{{ action('productController@postReadAll'); }}';
</script>
<script src="{{ asset("assets/scripts/product_ajax.js") }}" type="text/javascript"></script>

@stop