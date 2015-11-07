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
                                {{ Form::label('description','Descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'pro_description','placeholder' => 'Descripción'])}}
                            </div>                            
                            <div class="form-group">
                                {{ Form::label('outlay','Inversión')}}
                                {{ Form::number('outlay',null,['class' => 'form-control','id' => 'pro_outlay','placeholder' => '0.00', 'step' => '0.50']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('type','Tipo')}}
                                {{ Form::select('type',['null' => '---Seleccionar tipo---','Spot' => 'Spot', 'Web' => 'Web', 'Programa' => 'Programa', 'Producción' => 'Producción'],'null',['class' => 'form-control','id' => 'pro_type'])}} 
                            </div>
                            <!-- Para que se abra el contenido deseado según la selección, se debe agregar en selectProducts.js el ID de la selección y la clase que escucha a los menús -->
                            <div id="Spot" class="product" style="display:none">
                                <h3>Spot</h3>
                                <div class="form-group">
                                    {{ Form::label('impacts','Impactos')}}
                                    {{ Form::number('impacts',null,['class' => 'form-control','id' => 'spo_impacts','placeholder' => '0.00', 'step' => '1']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('duration','Duración')}}
                                    {{ Form::number('duration',null,['class' => 'form-control','id' => 'spo_duration','placeholder' => '0.00', 'step' => '1']) }}
                                </div> 
                            </div>
                            <div id="Web" class="product" style="display:none">
                                <h3>Web</h3>
                                <div class="form-group">
                                    {{ Form::label('validity','Vigencia')}}
                                    {{ Form::number('validity',null,['class' => 'form-control','id' => 'web_validity','placeholder' => '0.00', 'step' => '1']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('media','Medio Web')}}
                                    {{ Form::select('media',['null' => '---Seleccionar medio---','Facebook' => 'Facebook', 'Twitter' => 'Twitter', 'Youtube' => 'Youtube'],'null',['class' => 'form-control','id' => 'web_media'])}} 
                                </div>   
                            </div>
                            <div id="Programa" class="product" style="display:none">
                                <h3>Programa</h3>
                                <div class="form-group">
                                    {{ Form::label('duration','Duración')}}
                                    {{ Form::number('duration',null,['class' => 'form-control','id' => 'sho_duration','placeholder' => '0.00', 'step' => '1']) }}
                                </div> 
                            </div>
                            <div id="Producción" class="product" style="display:none">
                                <h3>Producción</h3>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('duration', '4', null, ['class' => '','id' => 'prd_need_dates'])}} ¿Debe tener un registro de producción?
                                    </label>
                                </div>                            
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
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'u_pro_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','Descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'u_pro_description','placeholder' => 'Descripción'])}}
                            </div>                            
                            <div class="form-group">
                                {{ Form::label('outlay','Inversión')}}
                                {{ Form::number('outlay',null,['class' => 'form-control','id' => 'u_pro_outlay','placeholder' => '0.00', 'step' => '0.50']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('type','Tipo')}}
                                {{ Form::select('type',['null' => '---Seleccionar tipo---','Spot' => 'Spot', 'Web' => 'Web', 'Programa' => 'Programa', 'Producción' => 'Producción'],'null',['class' => 'form-control','id' => 'u_pro_type', 'disabled' => 'true'])}} 
                            </div>
                            <!-- Para que se abra el contenido deseado según la selección, se debe agregar en selectProducts.js el ID de la selección y la clase que escucha a los menús -->
                            <div id="u_Spot" class="u_product" style="display:none">
                                <h3>Spot</h3>
                                <div class="form-group">
                                    {{ Form::label('impacts','Impactos')}}
                                    {{ Form::number('impacts',null,['class' => 'form-control','id' => 'u_spo_impacts','placeholder' => '0.00', 'step' => '1']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('duration','Duración')}}
                                    {{ Form::number('duration',null,['class' => 'form-control','id' => 'u_spo_duration','placeholder' => '0.00', 'step' => '1']) }}
                                </div> 
                            </div>
                            <div id="u_Web" class="u_product" style="display:none">
                                <h3>Web</h3>
                                <div class="form-group">
                                    {{ Form::label('validity','Vigencia')}}
                                    {{ Form::number('validity',null,['class' => 'form-control','id' => 'u_web_validity','placeholder' => '0.00', 'step' => '1']) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('media','Medio Web')}}
                                    {{ Form::select('media',['null' => '---Seleccionar medio---','Facebook' => 'Facebook', 'Twitter' => 'Twitter', 'Youtube' => 'Youtube'],'null',['class' => 'form-control','id' => 'u_web_media'])}} 
                                </div>   
                            </div>
                            <div id="u_Programa" class="u_product" style="display:none">
                                <h3>Programa</h3>
                                <div class="form-group">
                                    {{ Form::label('duration','Duración')}}
                                    {{ Form::number('duration',null,['class' => 'form-control','id' => 'u_sho_duration','placeholder' => '0.00', 'step' => '1']) }}
                                </div> 
                            </div>
                            <div id="u_Producción" class="u_product" style="display:none">
                                <h3>Producción</h3>
                                <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('duration', '4', null, ['class' => '','id' => 'u_prd_need_dates'])}} ¿Debe tener un registro de producción?
                                    </label>
                                </div>                            
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
                            <th>Descripción</th>
                            <th>Tipo</th>                                                    
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
    var readAllRoute = '{{ action('productController@postReadAll'); }}';</script>
    <script src="{{ asset("assets/scripts/product_ajax.js") }}" type="text/javascript"></script>

    @stop