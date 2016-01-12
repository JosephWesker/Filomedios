@extends('layouts.dashboard')
@section('page_heading','Paquetes')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addPackage">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Producto a Paquete</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('fk_product','Producto')}}
                                {{ Form::select('fk_product', ['null'=>'---Seleccionar producto---'],null,['class' => 'form-control','id'=>'pad_fk_product']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('outlay','Precio')}}
                                {{ Form::number('outlay',null,['disabled', 'class' => 'form-control','id' => 'pro_outlay','placeholder' => 'Precio'])}}
                            </div>
                            <div id="forType">
                                <div class="form-group">
                                    {{ Form::label('impacts','Impactos diarios')}}
                                    {{ Form::number('impacts',null,['class' => 'form-control','id' => 'pad_impacts','placeholder' => 'Impactos'])}}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('validity','Vigencia Mensual (En días)')}}
                                    {{ Form::number('validity',null,['class' => 'form-control','id' => 'pad_validity','placeholder' => 'Vigencia'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('discount','Descuento (%)')}}
                                {{ Form::number('discount',null,['onkeyup' => 'toDiscount_number()','class' => 'form-control','id' => 'pad_discount','placeholder' => 'Descuento'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('discount_number','Precio con Descuento')}}
                                {{ Form::number('discount_number',null,['onkeyup' => 'toDiscount()','class' => 'form-control','id' => 'pad_discount_number','placeholder' => 'Precio con Descuento'])}}
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
                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('fk_product','Producto')}}
                                {{ Form::select('fk_product', ['null'=>'---Seleccionar producto---'],null,['disabled','class' => 'form-control','id'=>'u_pad_fk_product']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('outlay','Precio')}}
                                {{ Form::number('outlay',null,['disabled', 'class' => 'form-control','id' => 'u_pro_outlay','placeholder' => 'Precio'])}}
                            </div>
                            <div id="u_forType">
                                <div class="form-group">
                                    {{ Form::label('impacts','Impactos diarios')}}
                                    {{ Form::number('impacts',null,['class' => 'form-control','id' => 'u_pad_impacts','placeholder' => 'Impactos'])}}
                                </div>
                                <div class="form-group">
                                    {{ Form::label('validity','Vigencia Mensual (En días)')}}
                                    {{ Form::number('validity',null,['class' => 'form-control','id' => 'u_pad_validity','placeholder' => 'Vigencia'])}}
                                </div>
                            </div>
                            <div class="form-group">
                                {{ Form::label('discount','Descuento (%)')}}
                                {{ Form::number('discount',null,['onkeyup' => 'u_toDiscount_number()','class' => 'form-control','id' => 'u_pad_discount','placeholder' => 'Descuento'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('discount_number','Precio con Descuento')}}
                                {{ Form::number('discount_number',null,['onkeyup' => 'u_toDiscount()','class' => 'form-control','id' => 'u_pad_discount_number','placeholder' => 'Precio con Descuento'])}}
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
        <div class="col-lg-9 table-responsive">
            <table class="table table-striped table-hover table-bordered margin-top20">
                <thead>
                        <tr>
                        <th>ID del Paquete</th>
                        <th>Nombre del Paquete</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody id="paquetes">
                    <tr class="gradeX">
                        <td id='pad_fk_package'>{{ $package->pac_id }}</td>
                        <td>{{ $package->pac_name }}</td>
                        <td>{{ $package->pac_description }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Button trigger modal -->
        <br>
        <button type="button" class="btn btn-success btn-lg col-lg-3" data-toggle="modal" data-target="#add">
            Agregar Producto a Paquete
        </button>

        <div class="col-lg-12 table-responsive">
            <table class="table table-striped table-hover table-bordered margin-top20">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Producto</th>
                        <th>Precio unitario</th>
                        <th>Impactos diarios</th>
                        <th>Vigencia Mensual</th>
                        <th>Descuento</th>
                        <th>Precio con descuento</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="detalles">
                <?php 
                    if (empty($details)) {
                        echo '<tr class="gradeX"><td colspan="9">no existen detalles para este Paquete</td>';
                    }else{
                        foreach ($details as $row) {
                            echo '<tr class="gradeX"><td>'.$row['pad_id'].'</td><td>'.$row['pro_name'].'</td><td>'.$row['pro_outlay'].'</td><td>'.$row['pad_impacts'].'</td><td>'.$row['pad_validity'].'</td><td>'.$row['pad_discount'].'</td><td>'.$row['pad_finalPrice'].'</td><td>'.$row['pad_subtotal'].'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('.$row['pad_id'].')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('.$row['pad_id'].')">Elminar</button></div></td></tr>';
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-11">
            
        </div>
        <div class="col-lg-1 table-responsive">
            <table class="table table-striped table-hover table-bordered margin-top20 ">
                <thead>
                    <tr>
                        <th>Costo Total</th>
                    </tr>
                </thead>
                <tbody id="detalles">
                    <td id='total_outlay'>{{ $total_outlay }}</td>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var createRoute = '{{ action('packageController@postCreateDetail'); }}';
var readRoute = '{{ action('packageController@postReadDetail'); }}';
var updateRoute = '{{ action('packageController@postUpdateDetail'); }}';
var deleteRoute = '{{ action('packageController@postDeleteDetail'); }}';
var readAllRoute = '{{ action('packageController@postReadAllDetail'); }}';
var loadProductsRoute = '{{ action('packageController@postLoadProducts'); }}';
var loadPriceProductRoute = '{{ action('packageController@postLoadPriceProduct'); }}';
</script>
<script src="{{ asset("assets/scripts/package_detail_ajax.js") }}" type="text/javascript"></script>

@stop