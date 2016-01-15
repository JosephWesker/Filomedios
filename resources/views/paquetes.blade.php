@extends('layouts.dashboard')
@section('page_heading','Paquetes')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
                Agregar Paquete
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addPackage">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Paquete</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'pac_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','Descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'pac_description','placeholder' => 'Descripción'])}}
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
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updatePackage">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modificar Paquete</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'actualizar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'u_pac_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('description','Descripción')}}
                                {{ Form::text('description',null,['class' => 'form-control','id' => 'u_pac_description','placeholder' => 'Descripción'])}}
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
            
            <!-- Modal for Update Price -->
            <div class="modal fade" id="updatePackagePrice" tabindex="-1" role="dialog" aria-labelledby="updatePackagePrice">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modificar Precio</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'actualizarPrecio')) }} 
                            <div class="form-group">
                                {{ Form::label('price','Inversión')}}
                                {{ Form::number('price',null,['class' => 'form-control','id' => 'u_pac_outlay','placeholder' => 'Precio'])}}
                            </div>                            
                            <div class=text-right>
                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'updatePrice()']) }}
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
                        <th>Inversión</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="paquetes">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var createRoute = '{{ action('packageController@postCreate'); }}';
var readRoute = '{{ action('packageController@postRead'); }}';
var updateRoute = '{{ action('packageController@postUpdate'); }}';
var deleteRoute = '{{ action('packageController@postDelete'); }}';
var readAllRoute = '{{ action('packageController@postReadAll'); }}';
var readPriceRoute = '{{ action('packageController@postReadPrice'); }}';
var updatePriceRoute = '{{ action('packageController@postUpdatePrice'); }}';
var detailPackageRoute = '{{ route('paquetes'); }}';
</script>
<script src="{{ asset("assets/scripts/package_ajax.js") }}" type="text/javascript"></script>

@stop