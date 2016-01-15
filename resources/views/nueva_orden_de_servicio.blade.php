@extends('layouts.dashboard')
@section('page_heading','Nueva Orden de Servicio')
@section('section')



<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                                    <div id="wizard">

                                        <h1>Cliente</h1> 
                                        <div class="step-content offset" style="position: relative; width: 100%;">                      
                                            <table class="table table-striped table-hover table-bordered margin-top20">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Contacto</th>                                                                                                        
                                                        <th>Razón Social</th>
                                                        <th>RFC</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="clientes">

                                                </tbody>
                                            </table>
                                        </div>

                                        <h1>Producto</h1>
                                        <div class="step-content offset" style="position: relative;">
                                            <form class="form-inline col-lg-12">
                                                <div class="row">
                                                    <div class="form-group col-sm-12">
                                                        <div class="row">
                                                            <button id="margin-bottom-20" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addProduct">
                                                                Agregar Producto
                                                            </button>
                                                            <button id="margin-bottom-20" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addPackage">
                                                                Agregar Paquete
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <div class="row">    
                                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                            <label for="start_date_contract">Fecha de Inicio</label>
                                                            <input type="date" id="start_date_contract" class="form-control" style="margin-bottom: 10px!important;" placeholder="Fecha de Inicio" disabled="true" onblur ="setEnableMonths()" onchange="setEnableMonths()" />
                                                        </div>
                                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                            <label for="months_contract">Duración del Contrato</label>
                                                            <input type="number" id="months_contract" class="form-control" style="margin-bottom: 10px!important;" placeholder="Meses" disabled="true" />
                                                        </div>
                                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                            <label for="end_date_contract">Fin del Contrato</label>
                                                            <input type="date" id="end_date_contract" class="form-control" style="margin-bottom: 10px!important;" placeholder="Fin del Contato" readonly/>
                                                        </div>
                                                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                            <label for="end_date_contract">Cobro Mensual</label>
                                                            <input type="text" id="ser_total" class="form-control" style="margin-bottom: 10px!important;" placeholder="Cobro Mensual" readonly/>
                                                        </div>   
                                                    </div>
                                                </div>
                                            </form>

                                            <!-- Button trigger modal -->
                                            <!-- Modal -->                                            
                                            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Agregar Producto</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                                                            <div class="form-group">
                                                                {{ Form::label('fk_product','Producto')}}
                                                                {{ Form::select('fk_product', ['null'=>'---Seleccionar producto---'],null,['class' => 'form-control','id'=>'det_fk_product','onchange' => 'setFormVisible()']) }}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('outlay','Precio')}}
                                                                {{ Form::number('outlay',null,['disabled', 'class' => 'form-control','id' => 'pro_outlay','placeholder' => 'Precio'])}}
                                                            </div>
                                                            <div id="proyection_data" style="display:none">
                                                                <div class="form-group">
                                                                    {{ Form::label('fk_business_unit','Unidad de Negocio de Reproducción')}}
                                                                    {{ Form::select('fk_business_unit', ['null'=>'---Seleccionar Unidad---'],null,['class' => 'form-control','id'=>'det_fk_business_unit']) }}
                                                                </div>
                                                                <div class="form-group" id="fk_show" style="display:none">
                                                                    {{ Form::label('fk_show','Programa')}}
                                                                    {{ Form::select('fk_show', ['null'=>'---Seleccionar Programa---'],null,['class' => 'form-control','id'=>'det_fk_show']) }}
                                                                </div>                                                                
                                                                <div class="form-group">
                                                                    {{ Form::label('impacts','Impactos')}}
                                                                    {{ Form::number('impacts',null,['class' => 'form-control','id' => 'det_impacts','placeholder' => 'Impactos'])}}
                                                                </div>
                                                                <div class="form-group">
                                                                    {{ Form::label('validity','Vigencia Mensual (En días)')}}
                                                                    {{ Form::number('validity',null,['class' => 'form-control','id' => 'det_validity','placeholder' => 'Vigencia'])}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('discount','Descuento (%)')}}
                                                                {{ Form::number('discount',null,['onkeyup' => 'toDiscount_number()','class' => 'form-control','id' => 'det_discount','placeholder' => 'Descuento'])}}
                                                            </div>                                                            
                                                            <div class="form-group">
                                                                {{ Form::label('discount_number','Precio con Descuento')}}
                                                                {{ Form::number('discount_number',null,['onkeyup' => 'toDiscount()','class' => 'form-control','id' => 'det_discount_number','placeholder' => 'Precio con Descuento'])}}
                                                            </div>

                                                            <div class=text-right>
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'addProduct()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Modal-->


                                            <!-- Modal Production Registry -->                                            
                                            <div class="modal fade" id="productionRegistry" tabindex="-1" role="dialog" aria-labelledby="addProduct">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Definir Esquema de Producción</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }}
                                                            {{ Form::hidden('index', 'index',['id' => 'productionRegistryIndex']) }} 
                                                            <div class="form-group">
                                                                <label for="recording_date">Fecha de Grabación</label>
                                                                <input type="date" id="dpr_recording_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Grabación"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="proposal_1_date">Fecha de Propuesta 1</label>
                                                                <input type="date" id="dpr_proposal_1_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Propuesta 1"/>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="proposal_2_date">Fecha de Propuesta 2</label>
                                                                <input type="date" id="dpr_proposal_2_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Propuesta 2"/>
                                                            </div>                                                                                                             
                                                            <div class=text-right>
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'addProductionRegistry()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Modal-->

                                            <!-- Modal Transmission Scheme -->                                            
                                            <div class="modal fade" id="transmissionScheme" tabindex="-1" role="dialog" aria-labelledby="addProduct">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Definir Esquema de Producción</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }}
                                                            {{ Form::hidden('index', 'index',['id' => 'transmissionSchemeIndex']) }} 
                                                            <div class="checkbox">
                                                                <label>
                                                                    {{ Form::checkbox('monday', '1', null, ['class' => '','id' => 'tra_monday'])}} Lunes
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    {{ Form::checkbox('tuesday', '2', null, ['class' => '','id' => 'tra_tuesday'])}} Martes
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    {{ Form::checkbox('wednesday', '3', null, ['class' => '','id' => 'tra_wednesday'])}} Miercoles
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    {{ Form::checkbox('thursday', '4', null, ['class' => '','id' => 'tra_thursday'])}} Jueves
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    {{ Form::checkbox('friday', '5', null, ['class' => '','id' => 'tra_friday'])}} Viernes
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    {{ Form::checkbox('saturday', '6', null, ['class' => '','id' => 'tra_saturday'])}} Sabado
                                                                </label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <label>
                                                                    {{ Form::checkbox('sunday', '7', null, ['class' => '','id' => 'tra_sunday'])}} Domingo
                                                                </label>
                                                            </div>                                                                                                            
                                                            <div class=text-right>
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'addTransmissionScheme()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Modal-->

                                            <!-- Modal Package -->                                            
                                            <div class="modal fade" id="addPackage" tabindex="-1" role="dialog" aria-labelledby="addPackage">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Agregar Paquete</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '#', 'id' => 'agregarPaquete')) }} 
                                                            <div class="form-group">
                                                                {{ Form::label('package','Paquete')}}
                                                                {{ Form::select('package', ['null'=>'---Seleccionar paquete---'],null,['class' => 'form-control','id'=>'det_add_package']) }}
                                                            </div>                                                            
                                                            <div class=text-right>
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'addPackage()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Modal-->

                                            <!-- Modal Business Unit -->                                            
                                            <div class="modal fade" id="setBusinessUnit" tabindex="-1" role="dialog" aria-labelledby="setBusinessUnit">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Definir Unidad de Negocio</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '#', 'id' => 'definirUnidad')) }} 
                                                            {{ Form::hidden('index', 'index',['id' => 'businessUnitIndex']) }}
                                                            <div class="form-group">
                                                                {{ Form::label('business_unit','Unidad de Negocio')}}
                                                                {{ Form::select('business_unit', ['null'=>'---Seleccionar Unidad---'],null,['class' => 'form-control','id'=>'set_business_unit']) }}
                                                            </div>                                                            
                                                            <div class=text-right>
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'addBusinessUnit()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Modal-->

                                            <!-- Modal Show -->                                            
                                            <div class="modal fade" id="setShow" tabindex="-1" role="dialog" aria-labelledby="setShow">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Definir Programa</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '#', 'id' => 'definirPrograma')) }} 
                                                            {{ Form::hidden('index', 'index',['id' => 'showIndex']) }}
                                                            <div class="form-group">
                                                                {{ Form::label('show','Programa')}}
                                                                {{ Form::select('show', ['null'=>'---Seleccionar Unidad---'],null,['class' => 'form-control','id'=>'set_show']) }}
                                                            </div>                                                            
                                                            <div class=text-right>
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'addShow()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End Modal-->

                                            <table class="table table-striped table-hover table-bordered margin-top20">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre del Producto</th>
                                                        <th>Impactos</th>
                                                        <th>Vigencia (Días)</th>
                                                        <th>Precio</th>
                                                        <th>Subtotal</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="products">

                                                </tbody>
                                            </table> 
                                        </div>                                                                          


                                        <h1>Pagos</h1>
                                        <div class="step-content offset" style="position: relative;">
                                            <form class="form-horizontal">

                                                <div class="form-group form-group-sm">                                                                                                    
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">Descuento Mensual</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="number" id="ser_discount_month" onkeyup="calculateDiscount()" onmouseup="calculateDiscount()">
                                                    </div>
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">Total Contrato</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="number" id="ser_outlay_total" readonly>
                                                    </div>
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">¿Facturar?</label>
                                                    <div class="col-sm-2">
                                                        {{ Form::checkbox('iva', '8', null, ['id' => 'has_iva','onclick' => 'setIVA()']) }}
                                                    </div>
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">IVA</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="number" id="ser_iva" readonly>
                                                    </div>
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall" >Pago Especie</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="number" id="amount_kind" onkeyup="calculateAmounts()" onmouseup="calculateAmounts()">
                                                    </div>
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">Pago en Moneda</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="number" id="amount_cash" readonly>
                                                    </div>                                                                                                    
                                                </div>

                                                <div class="form-group form-group-sm">

                                                </div>

                                                <div class="input_fields_wrap_payment">
                                                    <div id="1" class="form-group form-group-sm" style="margin-bottom: 10px!important; display: inline-block; width: 80%;">
                                                        <label class="col-sm-1 control-label" for="formGroupInputSmall">Monto</label>
                                                        <div class="col-sm-3">
                                                            <div class="">
                                                                <div>
                                                                    <input class="form-control" id="payment-1" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="text" name="mytext[]">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <label class="col-sm-1 control-label" for="formGroupInputSmall">Fecha</label>
                                                        <div class="col-sm-3">
                                                            <div class="">
                                                                <div>
                                                                    <input class="form-control" id="payment-2" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="#">
                                                            <i class="fa fa-plus-square add_field_button_payment" style="float: left; margin-left: 0; cursor: pointer; font-size: 30px; color: green;">
                                                            </i>
                                                        </a>
                                                    </div>
                                                </div>
                                                {{ Form::close() }}                        
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
                                                                    var loadCustomersRoute = '{{ action('serviceOrderController@postReadCustomers'); }}';
                                                                    var loadProductsDataRoute = '{{ action('serviceOrderController@postLoadProductsData'); }}';
                                                                    var loadSelectsRoute = '{{ action('serviceOrderController@postLoadSelects'); }}';
                                                                    var loadPackageRoute = '{{ action('serviceOrderController@postLoadPackages'); }}';
                                                                    var loadPackageDetailRoute = '{{ action('serviceOrderController@postLoadPackagesDetail'); }}';
                                                                    var createServiceOrderRoute = '{{ action('serviceOrderController@postCreateOrder'); }}';
                                                                    var valueToReturn = '{{ url ('gestor_de_ordenes_de_servicio') }}';</script>
<script src="{{ asset("assets/scripts/serviceOrder_ajax.js") }}" type="text/javascript"></script>
@stop