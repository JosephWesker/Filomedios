@extends('layouts.dashboard')
@section('page_heading','Productos')
@section('section')
<<<<<<< HEAD
=======


>>>>>>> Restructuring project :+1:
<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
<<<<<<< HEAD
            <button id="margin-bottom-20" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addProduct">
=======
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addProduct">
>>>>>>> Restructuring project :+1:
                Agregar Producto
            </button>

            <!-- Modal -->
<<<<<<< HEAD
            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel">
=======
            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct">
>>>>>>> Restructuring project :+1:
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<<<<<<< HEAD
                            <h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '', 'id' => 'agregarProducto')) }}                            
                            <div class="form-group">
                                {{  Form::label('pro_media','Medio') }}
                                {{  Form::select('age', array('1' => 'Plaza TV','2' => 'www.filomedios.com', '3' => 'FilomediosHD', '4' => 'Producciones' ),'1', ['class' => 'form-control','id'=>'pro_media']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('pro_description','Descripción')}}
                                {{ Form::textarea('pro_description','',['class' => 'form-control','id' => 'pro_description','placeholder' => 'Descripción'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('pro_outlay','Inversión Individual')}}
                                {{ Form::number('pro_outlay', 'Costo', ['class' => 'form-control', 'id' => 'pro_outlay', 'step' => '0.10']) }}
                            </div>
                            <div class=text-right>                                
                                {{ Form::button('Aceptar',['class' => 'btn btn-success', 'id' => 'createProduct']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss'=> "modal"]) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Update -->
            <div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modificar Producto</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '', 'id' => 'modificarProducto')) }}
                            {{ Form::hidden ('id',null,['id' => 'u_pro_id']) }}                            
                            <div class="form-group">
                                {{  Form::label('pro_media','Medio') }}
                                {{  Form::select('age', array('1' => 'Plaza TV','2' => 'www.filomedios.com', '3' => 'FilomediosHD', '4' => 'Producciones' ),'1', ['class' => 'form-control','id'=>'u_pro_media']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('pro_description','Descripción')}}
                                {{ Form::textarea('pro_description','',['class' => 'form-control','id' => 'u_pro_description','placeholder' => 'Descripción'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('pro_outlay','Inversión Individual')}}
                                {{ Form::number('pro_outlay', 'Costo', ['class' => 'form-control', 'id' => 'u_pro_outlay', 'step' => '0.10']) }}
                            </div>
                            <div class=text-right>                                
                                {{ Form::button('Aceptar',['class' => 'btn btn-success', 'id' => 'updateProductbutton']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss'=> "modal"]) }}
                            </div>
                            {{ Form::close() }}
=======
                            <h4 class="modal-title">Agregar Producto</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '', 'id' => 'agregarProducto')) }} 
                            <div class="form-group">
                                {{ Form::label('type','Tipo')}}
                                {{ Form::select('type', ['-- Selecciona tipo de producto -- ','Spot','Cintillo','Programa','Portal Noticias'] ,null, ['class' => 'form-control','id'=>'u_cus_fk_employee']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','Descripción')}}
                                {{ Form::textarea('description',null,['class' => 'form-control','id' => 'description','placeholder' => 'Descripción','rows' => '2'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('show','Programa')}}
                                {{ Form::select('show', ['-- Selecciona Programa --'] ,null, ['class' => 'form-control','id'=>'show']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('scheme','Esquema')}}
                                {{ Form::text('scheme',null,['class' => 'form-control','id' => 'scheme','placeholder' => 'Esquema'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('duration_type','Tipo de duración')}}
                                {{ Form::text('duration_type',null,['class' => 'form-control','id' => 'duration_type','placeholder' => 'Tipo de duración'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('duration','Duración')}}
                                {{ Form::text('duration',null,['class' => 'form-control','id' => 'duration','placeholder' => 'Duración'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('daily_impacts','Impactos Diarios')}}
                                {{ Form::text('daily_impacts',null,['class' => 'form-control','id' => 'daily_impacts','placeholder' => 'Impactos Duarios'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('outlay','Inversión')}}
                                {{ Form::text('outlay',null,['class' => 'form-control','id' => 'outlay','placeholder' => 'Inversión'])}}
                            </div>
                            <div class=text-right>
                                {{ Form::button('Aceptar',['class' => 'btn btn-success','id' => 'updateCustomerButton']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                            </div>
                            {{ Form::close() }}                         
>>>>>>> Restructuring project :+1:
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD

        </div>
=======
        </div>

>>>>>>> Restructuring project :+1:
        <div class="col-lg-12 table-responsive">
            <table class="table table-striped table-hover table-bordered margin-top20">
                <thead>
                    <tr>
                        <th>ID</th>
<<<<<<< HEAD
                        <th>Medio</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="productos">                    
=======
                        <th>Nombre Comercial</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody id="clientes">
>>>>>>> Restructuring project :+1:
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
<<<<<<< HEAD
var updateRoute = '{{ action('productController@postUpdate'); }}';
var readRoute = '{{ action('productController@postShow'); }}';
var delateRoute = '{{ action('productController@postDelate'); }}';
var createRoute = '{{ action('productController@postCreate'); }}';
var readAllRoute = '{{ action('productController@postShowAll'); }}';
</script>
<script src="{{ asset("assets/scripts/productos_ajax.js") }}"></script>
@stop
=======
        var showCustomersRoute = '{{ action('customerController@postShowCustomers'); }}';
        var showEmployeesSelectRoute = '{{ action('customerController@postShowEmployeesSelect'); }}';
        var showPostalCodeSelectRoute = '{{ action('customerController@postShowPostalCodeSelect'); }}';
        var createCustomerRoute = '{{ action('customerController@postCreateCustomer'); }}';
        var deleteRoute = '{{ action('customerController@postDeleteCustomer'); }}';
        var getCustomerRoute = '{{ action('customerController@postGetCustomer'); }}';
        var updateRoute = '{{ action('customerController@postUpdateCustomer'); }}';
        var getPostalData = '{{ action('customerController@postPostalData'); }}';</script>
<script src="{{ asset("assets/scripts/clientes_ajax.js") }}" type="text/javascript"></script>

@stop
>>>>>>> Restructuring project :+1:
