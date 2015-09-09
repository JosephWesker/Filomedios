@extends('layouts.dashboard')
@section('page_heading','Productos')
@section('section')
<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button id="margin-bottom-20" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addProduct">
                Agregar Producto
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                        <th>Medio</th>
                        <th>Descripción</th>
                        <th>Costo</th>
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
var updateRoute = '{{ action('productController@postUpdate'); }}';
var readRoute = '{{ action('productController@postShow'); }}';
var delateRoute = '{{ action('productController@postDelate'); }}';
var createRoute = '{{ action('productController@postCreate'); }}';
var readAllRoute = '{{ action('productController@postShowAll'); }}';
</script>
<script src="{{ asset("assets/scripts/productos_ajax.js") }}"></script>
@stop