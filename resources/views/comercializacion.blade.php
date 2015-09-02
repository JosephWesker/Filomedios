@extends('layouts.dashboard')
@section('page_heading','Comercialización')
@section('section')



<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Nueva Orden de Servicio</h5>
                                </div>
                                <div class="ibox-content">
                                    <div id="wizard">
                                        <h1>Cliente</h1> 
                                        <div class="step-content offset" style="position: relative; width: 100%;">


                                            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addCustomer">
                                                Agregar Cliente
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="addCustomerLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Agregar Cliente</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '', 'id' => 'agregarCliente')) }} 
                                                            <h3><b>Datos Generales</b></h3>
                                                            <hr>
                                                            <div class="form-group">
                                                                {{ Form::label('commercialName','Nombre Comercial')}}
                                                                {{ Form::text('commercialName',null,['class' => 'form-control','id' => 'cus_commercial_name','placeholder' => 'Nombre Comercial'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('contact','Nombre de la persona Contacto')}}
                                                                {{ Form::text('contact',null,['class' => 'form-control','id' => 'cus_contact_first_name','placeholder' => 'Contacto'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('contact','Apellidos de la persona de contacto')}}
                                                                {{ Form::text('contact',null,['class' => 'form-control','id' => 'cus_contact_last_names','placeholder' => 'Contacto'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('job','Puesto')}}
                                                                {{ Form::text('job',null,['class' => 'form-control','id' => 'cus_job','placeholder' => 'Puesto'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('phone','Teléfono Fijo')}}
                                                                {{ Form::text('phone',null,['class' => 'form-control','id' => 'cus_phone_number','placeholder' => 'Teléfono Fijo'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('cellphoneOrNextel','Celular o Nextel')}}
                                                                {{ Form::text('cellphoneOrNextel',null,['class' => 'form-control','id' => 'cus_cellphone_number','placeholder' => 'Celular o Nextel'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('email','Email')}}
                                                                {{ Form::email('email',null,['class' => 'form-control','id' => 'cus_email','placeholder' => 'Email'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('address','Dirección')}}
                                                                {{ Form::text('address',null,['class' => 'form-control','id' => 'cus_address','placeholder' => 'Dirección'])}}
                                                            </div>                                                          
                                                            <div class="form-group">
                                                                {{ Form::label('seller','Vendedor Asignado')}}
                                                                {{ Form::select('age', [] ,null, ['class' => 'form-control','id'=>'cus_fk_employee']) }}
                                                            </div>
                                                            <h3><b>Datos Fiscales</b></h3>
                                                            <hr>
                                                            <div class="form-group">
                                                                {{ Form::label('rfc','RFC')}}
                                                                {{ Form::text('rfc',null,['class' => 'form-control','id' => 'tax_rfc','placeholder' => 'RFC'])}}
                                                            </div>
                                                            <div class="form-group"> 
                                                                {{ Form::label('businessName','Razón Social')}}
                                                                {{ Form::text('businessName',null,['class' => 'form-control','id' => 'tax_business_name','placeholder' => 'Razón Social'])}}
                                                            </div>  
                                                            <div class="form-group">
                                                                {{ Form::label('street','Calle')}}
                                                                {{ Form::text('street',null,['class' => 'form-control','id' => 'tax_street','placeholder' => 'Calle'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('outsideNumber','Número Exterior')}}
                                                                {{ Form::text('outsideNumber',null,['class' => 'form-control','id' => 'tax_outdoor_number','placeholder' => 'Número Exterior'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('insideNumber','Número Interior')}}
                                                                {{ Form::text('insideNumber',null,['class' => 'form-control','id' => 'tax_apartment_number','placeholder' => 'Número Interior'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('postCode','Código Postal')}}
                                                                {{ Form::text('postCode',null,['class' => 'form-control','id' => 'tax_postal_code','placeholder' => 'Código Postal'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('cologne','Colonia')}}
                                                                {{ Form::text('cologne',null,['class' => 'form-control','id' => 'tax_colony','placeholder' => 'Colonia'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('town','Municipio')}}
                                                                {{ Form::text('town',null,['class' => 'form-control','id' => 'tax_town','placeholder' => 'Municipio'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('locality','Localidad')}}
                                                                {{ Form::text('locality',null,['class' => 'form-control','id' => 'tax_locality','placeholder' => 'Localidad'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('state','Estado')}}
                                                                {{ Form::text('state',null,['class' => 'form-control','id' => 'tax_state','placeholder' => 'Estado'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('country','País')}}
                                                                {{ Form::text('country',null,['class' => 'form-control','id' => 'tax_country','placeholder' => 'País'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('emailProsecutor','Email Fiscal')}}
                                                                {{ Form::email('emailProsecutor',null,['class' => 'form-control','id' => 'tax_tax_email','placeholder' => 'Email Fiscal'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('legalRepresentative','Representante Legal')}}
                                                                {{ Form::text('country',null,['class' => 'form-control','id' => 'tax_legal_representative','placeholder' => 'País'])}}
                                                            </div>
                                                            <div class=text-right>
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'customerCreate()']) }}
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped table-hover table-bordered margin-top20" id="selectTable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Contacto</th>
                                                        <th>Dirección</th>
                                                        <th>Teléfono Fijo</th>
                                                        <th>Celular o Nextel</th>
                                                        <th>Email</th>
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
                                                <div class="form-group col-lg-12 col-xs-12">
                                                    <button id="margin-bottom-20" type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addProduct">
                                                        Agregar Producto
                                                    </button>
                                                </div>  
                                            </form>


                                            <!-- Button trigger modal -->


                                            <!-- Modal -->
                                            <div class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProductLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '', 'id' => 'agregarProducto')) }}                            

                                                            <Select id="productSelector" class="form-control">
                                                                <option disabled selected>-- Selecciona un producto --</option>
                                                                <option value="spots">Spots</option>
                                                                <option value="cintillos">Cintillos</option>
                                                                <option value="programas">Programas</option>
                                                                <option value="portalNoticias">Portal Noticias</option>
                                                            </Select>
                                                            <div id="spots" class="product" style="display:none">
                                                                <h3>Spots</h3>
                                                                <form class="form-inline">
                                                                    <div class="form-group">
                                                                        <label>Spots por Hora</label>
                                                                        <input type="text" id="hour3" class="form-control" placeholder="Spots por Hora"/>
                                                                        <br>
                                                                        <label class="">Spots por Día: </label>
                                                                        <span id="day3"></span>
                                                                        <br>
                                                                        <label class="">Spots por Mes: </label>
                                                                        <span id="month3"></span>
                                                                    </div>
                                                                    <br>
                                                                    <div id="myRadioGroup">
                                                                        <h4>Producción Filomedios</h4>
                                                                        <label class="checkbox-inline">
                                                                            <input type="radio" name="cars" checked="checked" value="2"  />Si
                                                                        </label>
                                                                        <label class="checkbox-inline">
                                                                            <input type="radio" name="cars" value="3" />No
                                                                        </label>
                                                                        <div id="option2" class="desc">
                                                                            <div class="form-group">
                                                                                <label for="start_date">Fecha de grabación o junta de producción</label>
                                                                                <input type="date" id="start_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="start_date">Fecha Estimada 1 Propuesta</label>
                                                                                <input type="date" id="start_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"/>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="start_date">Fecha Estimada 2 Propuesta</label>
                                                                                <input type="date" id="start_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"/>
                                                                            </div>
                                                                        </div>
                                                                        <div id="option3" class="desc" style="display: none;">
                                                                            <div class="form-group">
                                                                                <label for="start_date">Fecha de Entrega Spot de Cliente</label>
                                                                                <input type="date" id="start_date" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"/>
                                                                            </div>
                                                                            <br>
                                                                            <div class="form-group">
                                                                                <label for="format">Formato</label>
                                                                                <input type="text" id="months" class="form-control" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Formato"/>
                                                                            </div>
                                                                            <br>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div id="cintillos" class="product" style="display:none">
                                                                <h3>Cintillos</h3>
                                                                <label>Cintillos por Hora</label>
                                                                <input type="text" id="hour" class="form-control" placeholder="Spots por Hora"/>
                                                                <br>
                                                                <label class="">Cintillos por Día: </label>
                                                                <span id="day"></span>
                                                                <br>
                                                                <label class="">Cintillos por Mes: </label>
                                                                <span id="month"></span>
                                                                <br>
                                                                <br>
                                                                <label>Observaciones</label>
                                                                <textarea type="text" id="observaciones" class="form-control" placeholder="Observaciones"/></textarea>

                                                                <div id="" class="desc" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="observaciones">Observaciones</label>
                                                                        <input type="text" id="observaciones" class="form-control" rows="3" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Observaciones"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="programas" class="product" style="display:none">
                                                                <h3>Programas</h3>
                                                                <label>Spots por Hora</label>
                                                                <input type="text" id="hour2" class="form-control" placeholder="Spots por Hora"/>
                                                                <br>
                                                                <label class="">Spots por Día: </label>
                                                                <span id="day2"></span>
                                                                <br>
                                                                <label class="">Spots por Mes: </label>
                                                                <span id="month2"></span>
                                                                <br>
                                                                <br>
                                                                <Select id="program" class="form-control">
                                                                    <option disabled selected>-- Selecciona un programa --</option>
                                                                    <option value="alAire">Al Aire</option>
                                                                    <option value="americasLife">Americas Life</option>
                                                                    <option value="deporteal100">Deporte al 100</option>
                                                                    <option value="Venue">Venue</option>
                                                                    <option value="Bloopers">Bloopers</option>
                                                                    <option value="veracruzEnTusSentidos">Veracruz en tu sentidos</option>
                                                                    <option value="los5MejoresGoles">Los 5 mejores goles</option>
                                                                </Select>
                                                                <br>
                                                                <label>Observaciones</label>
                                                                <textarea type="text" id="observaciones" class="form-control" placeholder="Observaciones"/></textarea>
                                                                <div id="" class="desc" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="observaciones">Observaciones</label>
                                                                        <input type="text" id="observaciones" class="form-control" rows="3" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Observaciones"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="portalNoticias" class="product" style="display:none">
                                                                <h3>Portal Noticias</h3>
                                                                <label>Observaciones</label>
                                                                <textarea type="text" id="observaciones" class="form-control" placeholder="Observaciones"/></textarea>
                                                                <div id="" class="desc" style="display: none;">
                                                                    <div class="form-group">
                                                                        <label for="observaciones">Descripción</label>
                                                                        <input type="text" id="observaciones" class="form-control" rows="3" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Observaciones"/>
                                                                    </div>
                                                                </div>
                                                            </div>

<!--                                                            <select class="form-control">
                                                              
                                                            </select>-->
                                                            <br>
                                                            <div class=text-right>
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss'=> "modal"]) }}
                                                                {{ Form::button('Agregar',['class' => 'btn btn-success', 'id' => 'createProduct']) }}
                                                            </div>
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped table-hover table-bordered margin-top20" id="selectTable">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nombre Comercial</th>
                                                        <th>Contacto</th>
                                                        <th>Dirección</th>
                                                        <th>Teléfono Fijo</th>
                                                        <th>Celular o Nextel</th>
                                                        <th>Email</th>
                                                        <th>Razón Social</th>
                                                        <th>RFC</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="clientes">

                                                </tbody>
                                            </table>
                                        </div>

                                        <h1>Pagos</h1>


                                        <div class="step-content offset" style="position: relative;">
                                            <form class="form-horizontal">

                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-4 control-label" for="formGroupInputSmall">Últimos 4 dígitos cuenta que paga</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
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
        var showCustomersRoute = '{{ action('customerController@postShowCustomers'); }}';
        var showEmployeesSelectRoute = '{{ action('customerController@postShowEmployeesSelect'); }}';
        var createCustomerRoute = '{{ action('customerController@postCreateCustomer'); }}';</script>
<script src="{{ asset("assets/scripts/orden_de_servicio_ajax.js") }}" type="text/javascript"></script>
@stop