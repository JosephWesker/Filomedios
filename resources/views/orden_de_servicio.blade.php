@extends('layouts.dashboard')
@section('page_heading','Gestor de Ordenes de Servicio')
@section('section')
<link href="{{ asset("assets/stylesheets/gestor_de_ordenes_de_servicio.css") }}" rel="stylesheet">

<div class="col-sm-12">
    <div class="row">                
        <div class="col-lg-12">    
            <div class="full-width-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active fill_width"><a href="#generals" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Datos del cliente</a></li>
                    <li role="presentation" class="fill_width"><a href="#production" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Datos para producción</a></li>
                    <li role="presentation" class="fill_width"><a href="#proyection" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Datos para proyección</a></li>
                    <li role="presentation" class="fill_width"><a href="#payments" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Datos Para Cobranza</a></li>
                    <li role="presentation" class="fill_width"><a href="#files" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Archivos</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="generals" aria-labelledby="home-tab">
                        <div class="col-lg-6">    
                           {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                           <h3><b>Datos Generales</b></h3>
                           <hr>
                           <div class="form-group">
                            {{ Form::label('commercial_name','Nombre Comercial')}}
                            {{ Form::text('commercial_name',null,['class' => 'form-control generals','id' => 'cus_commercial_name','placeholder' => 'Nombre Comercial', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('business_activity','Actividad o Giro')}}
                            {{ Form::text('business_activity',null,['class' => 'form-control generals','id' => 'cus_business_activity','placeholder' => 'Actividad o Giro', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('contact_first_name','Nombre de la persona Contacto')}}
                            {{ Form::text('contact_first_name',null,['class' => 'form-control generals','id' => 'cus_contact_first_name','placeholder' => 'Contacto', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('contact_last_name','Apellidos de la persona de contacto')}}
                            {{ Form::text('contact_last_name',null,['class' => 'form-control generals','id' => 'cus_contact_last_name','placeholder' => 'Contacto', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('job','Puesto')}}
                            {{ Form::text('job',null,['class' => 'form-control generals','id' => 'cus_job','placeholder' => 'Puesto', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('phone_number','Teléfono Fijo')}}
                            {{ Form::text('phone_number',null,['class' => 'form-control generals','id' => 'cus_phone_number','placeholder' => 'Teléfono Fijo', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('cellphone_number','Celular o Nextel')}}
                            {{ Form::text('cellphone_number',null,['class' => 'form-control generals','id' => 'cus_cellphone_number','placeholder' => 'Celular o Nextel', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email','Email')}}
                            {{ Form::email('email',null,['class' => 'form-control generals','id' => 'cus_email','placeholder' => 'Email', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('address','Dirección')}}
                            {{ Form::text('address',null,['class' => 'form-control generals','id' => 'cus_address','placeholder' => 'Dirección', 'disabled' => 'true'])}}
                        </div>
                    </div>
                    <div class="col-lg-6">                                                         
                        <h3><b>Datos Fiscales</b></h3>
                        <hr>
                        <div class="form-group">
                            {{ Form::label('rfc','RFC')}}
                            {{ Form::text('rfc',null,['class' => 'form-control generals','id' => 'tax_rfc','placeholder' => 'RFC', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group"> 
                            {{ Form::label('business_name','Razón Social')}}
                            {{ Form::text('business_name',null,['class' => 'form-control generals','id' => 'tax_business_name','placeholder' => 'Razón Social', 'disabled' => 'true'])}}
                        </div>  
                        <div class="form-group">
                            {{ Form::label('street','Calle')}}
                            {{ Form::text('street',null,['class' => 'form-control generals','id' => 'tax_street','placeholder' => 'Calle', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('outdoor_number','Número Exterior')}}
                            {{ Form::text('outdoor_number',null,['class' => 'form-control generals','id' => 'tax_outdoor_number','placeholder' => 'Número Exterior', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('apartment_number','Número Interior')}}
                            {{ Form::text('apartment_number',null,['class' => 'form-control generals','id' => 'tax_apartment_number','placeholder' => 'Número Interior', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('postal_code','Código Postal')}}
                            {{ Form::select('postal_code', ['null'=>'---Seleccionar Código Postal---'] ,null, ['class' => 'form-control generals','id'=>'tax_postal_code', 'disabled' => 'true']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('colony','Colonia')}}
                            {{ Form::select('colony', [''=>'---Seleccionar Colonia---'] ,null, ['class' => 'form-control generals','id'=>'tax_colony', 'disabled' => 'true']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('town','Municipio')}}
                            {{ Form::text('town',null,['class' => 'form-control','id' => 'tax_town','placeholder' => 'Municipio', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('locality','Localidad')}}
                            {{ Form::text('locality',null,['class' => 'form-control generals','id' => 'tax_locality','placeholder' => 'Localidad', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('state','Estado')}}
                            {{ Form::text('state',null,['class' => 'form-control','id' => 'tax_state','placeholder' => 'Estado', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('country','País')}}
                            {{ Form::text('country',null,['class' => 'form-control','id' => 'tax_country','placeholder' => 'País', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('tax_email','Email Fiscal')}}
                            {{ Form::email('tax_email',null,['class' => 'form-control generals','id' => 'tax_tax_email','placeholder' => 'Email Fiscal', 'disabled' => 'true'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('legal_representative','Representante Legal')}}
                            {{ Form::text('legal_representative',null,['class' => 'form-control generals','id' => 'tax_legal_representative','placeholder' => 'Representante Legal', 'disabled' => 'true'])}}
                        </div>
                        <div class=text-right>
                            {{ Form::button('Guardar',['class' => 'btn btn-success generals','onclick' => 'updateCustomer()', 'disabled'=>'true']) }}                        
                        </div>
                        {{ Form::close() }}
                    </table> 
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="production" aria-labelledby="profile-tab">
                <div class="col-lg-12">                        
                    <h3><b>Producciones</b></h3> 
                    <hr>
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Fecha Grabación</th>
                                <th>Fecha Primer Propuesta</th>
                                <th>Fecha Segunda Propuesta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="producciones">

                        </tbody>
                    </table> 
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="proyection" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <h3><b>Fecha y Duración del Contrato</b></h3> 
                    <hr>   
                    <form class="form col-lg-12">
                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <label for="months_contract">Duración del Contrato</label>
                            <input type="number" id="months_contract" class="form-control proyection" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Meses" disabled="true" />
                        </div>
                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <label for="start_date_contract">Fecha de Inicio</label>
                            <input type="date" id="start_date_contract" class="form-control proyection" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fecha de Inicio"  onblur ="setEnableMonths()" onchange="setEnableMonths()" disabled="true"/>
                        </div>                                
                        <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-4">
                            <label for="end_date_contract">Fin del Contrato</label>
                            <input type="date" id="end_date_contract" class="form-control proyection" style="margin-bottom: 10px!important; display: inline-block;" placeholder="Fin del Contato" disabled="true"/>
                        </div>                                                                                
                    </form>
                    <h3><b>Proyecciones</b></h3> 
                    <hr>
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
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
                        <tbody id="proyecciones">

                        </tbody>
                    </table> 
                </div>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="payments" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <h3><b>Inversión</b></h3> 
                    <hr>
                    <form class="form-horizontal">
                        <div class="form-group">    
                            <label class="col-sm-4 control-label" for="formGroupInputSmall">Descuento Mensual</label>
                            <div class="col-sm-2">
                                <input class="form-control payments" type="number" id="ser_discount_month" onkeyup="calculateDiscount()" onmouseup="calculateDiscount()" disabled="true">
                            </div>
                            <label class="col-sm-4 control-label" for="formGroupInputSmall">Total Contrato</label>
                            <div class="col-sm-2">
                                <input class="form-control payments" type="number" id="ser_outlay_total" disabled="true">
                            </div>
                            <label class="col-sm-4 control-label" for="formGroupInputSmall">¿Facturar?</label>
                            <div class="col-sm-2">
                                {{ Form::checkbox('iva', '8', null, ['class' => 'payments' ,'id' => 'has_iva','onclick' => 'setIVA()', 'disabled'=>'true']) }}
                            </div>
                            <label class="col-sm-4 control-label" for="formGroupInputSmall">IVA</label>
                            <div class="col-sm-2">
                                <input class="form-control payments" type="number" id="ser_iva" disabled="true">
                            </div>
                            <label class="col-sm-4 control-label" for="formGroupInputSmall" >Pago Especie</label>
                            <div class="col-sm-2">
                                <input class="form-control payments" type="number" id="amount_kind" onkeyup="calculateAmounts()" onmouseup="calculateAmounts()" disabled="true">
                            </div>
                            <label class="col-sm-4 control-label" for="formGroupInputSmall">Pago en Moneda</label>
                            <div class="col-sm-2">
                                <input class="form-control payments" type="number" id="amount_cash" disabled="true">
                            </div>
                        </div>
                    </form>
                    <h3><b>Pagos</b></h3> 
                    <hr> 
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>Monto</th>
                                <th>Fecha</th>                                    
                                <th>Acciones</th>                                        
                            </tr>
                        </thead>
                        <tbody id="pagos">

                        </tbody>
                    </table>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="files" aria-labelledby="profile-tab">
                <div class="col-lg-12">
                    <h3><b>Cargar Archivos</b></h3> 
                    <hr>
                </div>
                <div class="col-lg-12">
                    <h3><b>Archivos Cargados</b></h3> 
                    <hr>
                    <table class="table table-striped table-hover table-bordered margin-top20">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>                                        
                            </tr>
                        </thead>
                        <tbody id="canceladas">

                        </tbody>
                    </table>
                </div>

            </div>                    
        </div>
    </div>
</div>
</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>       
    var json = {{ $json }};
    var AddressData = {{ $AddressData }};
    var editable = {{ $editable }};
    var readPostalCodesRoute = '{{ action('customerController@postReadPostalCodes'); }}';
    var readAddressData = '{{ action('customerController@postReadAddressData'); }}';
    var updateRoute = '{{ action('customerController@postUpdate'); }}';
</script>
<script src="{{ asset("assets/scripts/serviceOrderView_ajax.js") }}" type="text/javascript"></script>

@stop
