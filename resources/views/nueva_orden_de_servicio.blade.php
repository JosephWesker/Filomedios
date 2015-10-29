@extends('layouts.dashboard')
@section('page_heading','Nueva Órden de Servicio')
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
                                            <table class="table table-striped table-hover table-bordered margin-top20" id="selectTable">
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
                                                <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                    <label for="start_date_contract">Fecha de Inicio</label>
                                                    <input type="date" id="start_date_contract" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"/>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                    <label for="months_contract">Duración del Contrato</label>
                                                    <input type="number" id="months_contract" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Meses"/>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                    <label for="end_date_contract">Fin del Contrato</label>
                                                    <input type="date" id="end_date_contract" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fin del Contato" readonly/>
                                                </div>
                                                <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-3">
                                                    <label for="end_date_contract">Cobro Mensual</label>
                                                    <input type="text" id="ser_total" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Cobro Mensual" readonly/>
                                                </div>                                                 
                                                <div class="form-group col-lg-6 col-xs-12">
                                                    <button id="margin-bottom-20" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addProduct">
                                                        Agregar Producto
                                                    </button>
                                                </div>
                                                <div class="form-group col-lg-6 col-xs-12">
                                                    <button id="margin-bottom-20" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addPackage">
                                                        Agregar Paquete
                                                    </button>
                                                </div>
                                            </form>

                                            <!-- Button trigger modal -->
                                            <!-- Modal -->                                            
                                            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct">
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
                                                                {{ Form::select('fk_product', ['null'=>'---Seleccionar producto---'],null,['class' => 'form-control','id'=>'det_fk_product']) }}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('fk_business_unit','Unidad de Negocio de Reproducción')}}
                                                                {{ Form::select('fk_business_unit', ['null'=>'---Seleccionar Unidad---'],null,['class' => 'form-control','id'=>'det_fk_business_unit']) }}
                                                            </div>
                                                            <div class="form-group" id="fk_show">
                                                                {{ Form::label('fk_show','Programa')}}
                                                                {{ Form::select('fk_show', ['null'=>'---Seleccionar Programa---'],null,['class' => 'form-control','id'=>'det_fk_show']) }}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('outlay','Precio')}}
                                                                {{ Form::number('outlay',null,['disabled', 'class' => 'form-control','id' => 'pro_outlay','placeholder' => 'Precio'])}}
                                                            </div>
                                                             <div class="form-group">
                                                                {{ Form::label('impacts','Impactos (Por día)')}}
                                                                {{ Form::number('impacts',null,['class' => 'form-control','id' => 'det_impacts','placeholder' => 'Impactos'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('validity','Vigencia (En Días)')}}
                                                                {{ Form::number('validity',null,['class' => 'form-control','id' => 'det_validity','placeholder' => 'Vigencia'])}}
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
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'create()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                 </div>
                                             </div>
                                            </div>
                                            <!--End Modal-->

                                            <table class="table table-striped table-hover table-bordered margin-top20" id="selectTable">
                                                <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th>Descripción</th>
                                                        <th>Monto</th>
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
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">Últimos 4 dígitos cuenta que paga</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text" id="ser_account_payment">
                                                    </div>
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">Descuento Mensual</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text" id="ser_account_payment">
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
    </script>
    <script src="{{ asset("assets/scripts/serviceOrder_ajax.js") }}" type="text/javascript"></script>
    @stop