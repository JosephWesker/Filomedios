@extends('layouts.dashboard')
@section('page_heading','Clientes')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
                Agregar Cliente
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addCustomer">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Cliente</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <h3><b>Datos Generales</b></h3>
                            <hr>
                            <div class="form-group">
                                {{ Form::label('commercial_name','Nombre Comercial')}}
                                {{ Form::text('commercial_name',null,['class' => 'form-control','id' => 'cus_commercial_name','placeholder' => 'Nombre Comercial'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('business_activity','Actividad o Giro')}}
                                {{ Form::text('business_activity',null,['class' => 'form-control','id' => 'cus_business_activity','placeholder' => 'Actividad o Giro'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('contact_first_name','Nombre de la persona Contacto')}}
                                {{ Form::text('contact_first_name',null,['class' => 'form-control','id' => 'cus_contact_first_name','placeholder' => 'Contacto'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('contact_last_name','Apellidos de la persona de contacto')}}
                                {{ Form::text('contact_last_name',null,['class' => 'form-control','id' => 'cus_contact_last_name','placeholder' => 'Contacto'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('job','Puesto')}}
                                {{ Form::text('job',null,['class' => 'form-control','id' => 'cus_job','placeholder' => 'Puesto'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('phone_number','Teléfono Fijo')}}
                                {{ Form::text('phone_number',null,['class' => 'form-control','id' => 'cus_phone_number','placeholder' => 'Teléfono Fijo'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('cellphone_number','Celular o Nextel')}}
                                {{ Form::text('cellphone_number',null,['class' => 'form-control','id' => 'cus_cellphone_number','placeholder' => 'Celular o Nextel'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email','Email')}}
                                {{ Form::email('email',null,['class' => 'form-control','id' => 'cus_email','placeholder' => 'Email'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('address','Dirección')}}
                                {{ Form::text('address',null,['class' => 'form-control','id' => 'cus_address','placeholder' => 'Dirección'])}}
                            </div>                                                          
                            <h3><b>Datos Fiscales</b></h3>
                            <hr>
                            <div class="form-group">
                                {{ Form::label('rfc','RFC')}}
                                {{ Form::text('rfc',null,['class' => 'form-control','id' => 'tax_rfc','placeholder' => 'RFC'])}}
                            </div>
                            <div class="form-group"> 
                                {{ Form::label('business_name','Razón Social')}}
                                {{ Form::text('business_name',null,['class' => 'form-control','id' => 'tax_business_name','placeholder' => 'Razón Social'])}}
                            </div>  
                            <div class="form-group">
                                {{ Form::label('street','Calle')}}
                                {{ Form::text('street',null,['class' => 'form-control','id' => 'tax_street','placeholder' => 'Calle'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('outdoor_number','Número Exterior')}}
                                {{ Form::text('outdoor_number',null,['class' => 'form-control','id' => 'tax_outdoor_number','placeholder' => 'Número Exterior'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('apartment_number','Número Interior')}}
                                {{ Form::text('apartment_number',null,['class' => 'form-control','id' => 'tax_apartment_number','placeholder' => 'Número Interior'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('postal_code','Código Postal')}}
                                {{ Form::select('postal_code', ['null'=>'---Seleccionar Código Postal---'] ,null, ['class' => 'form-control','id'=>'tax_postal_code']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('colony','Colonia')}}
                                {{ Form::select('colony', [''=>'---Seleccionar Colonia---'] ,null, ['class' => 'form-control','id'=>'tax_colony', 'disabled' => 'disabled']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('town','Municipio')}}
                                {{ Form::text('town',null,['class' => 'form-control','id' => 'tax_town','placeholder' => 'Municipio', 'disabled' => 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('locality','Localidad')}}
                                {{ Form::text('locality',null,['class' => 'form-control','id' => 'tax_locality','placeholder' => 'Localidad'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('state','Estado')}}
                                {{ Form::text('state',null,['class' => 'form-control','id' => 'tax_state','placeholder' => 'Estado', 'disabled' => 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('country','País')}}
                                {{ Form::text('country',null,['class' => 'form-control','id' => 'tax_country','placeholder' => 'País', 'disabled' => 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('tax_email','Email Fiscal')}}
                                {{ Form::email('tax_email',null,['class' => 'form-control','id' => 'tax_tax_email','placeholder' => 'Email Fiscal'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('legal_representative','Representante Legal')}}
                                {{ Form::text('legal_representative',null,['class' => 'form-control','id' => 'tax_legal_representative','placeholder' => 'Representante Legal'])}}
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
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateCustomer">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modificar Cliente</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'actualizar')) }} 
                            <h3><b>Datos Generales</b></h3>
                            <hr>
                            <div class="form-group">
                                {{ Form::label('commercial_name','Nombre Comercial')}}
                                {{ Form::text('commercial_name',null,['class' => 'form-control','id' => 'u_cus_commercial_name','placeholder' => 'Nombre Comercial'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('business_activity','Actividad o Giro')}}
                                {{ Form::text('business_activity',null,['class' => 'form-control','id' => 'u_cus_business_activity','placeholder' => 'Actividad o Giro'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('contact_first_name','Nombre de la persona Contacto')}}
                                {{ Form::text('contact_first_name',null,['class' => 'form-control','id' => 'u_cus_contact_first_name','placeholder' => 'Contacto'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('contact_last_name','Apellidos de la persona de contacto')}}
                                {{ Form::text('contact_last_name',null,['class' => 'form-control','id' => 'u_cus_contact_last_name','placeholder' => 'Contacto'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('job','Puesto')}}
                                {{ Form::text('job',null,['class' => 'form-control','id' => 'u_cus_job','placeholder' => 'Puesto'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('phone_number','Teléfono Fijo')}}
                                {{ Form::text('phone_number',null,['class' => 'form-control','id' => 'u_cus_phone_number','placeholder' => 'Teléfono Fijo'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('cellphone_number','Celular o Nextel')}}
                                {{ Form::text('cellphone_number',null,['class' => 'form-control','id' => 'u_cus_cellphone_number','placeholder' => 'Celular o Nextel'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email','Email')}}
                                {{ Form::email('email',null,['class' => 'form-control','id' => 'u_cus_email','placeholder' => 'Email'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('address','Dirección')}}
                                {{ Form::text('address',null,['class' => 'form-control','id' => 'u_cus_address','placeholder' => 'Dirección'])}}
                            </div>                                                          
                            <h3><b>Datos Fiscales</b></h3>
                            <hr>
                            <div class="form-group">
                                {{ Form::label('rfc','RFC')}}
                                {{ Form::text('rfc',null,['class' => 'form-control','id' => 'u_tax_rfc','placeholder' => 'RFC'])}}
                            </div>
                            <div class="form-group"> 
                                {{ Form::label('business_name','Razón Social')}}
                                {{ Form::text('business_name',null,['class' => 'form-control','id' => 'u_tax_business_name','placeholder' => 'Razón Social'])}}
                            </div>  
                            <div class="form-group">
                                {{ Form::label('street','Calle')}}
                                {{ Form::text('street',null,['class' => 'form-control','id' => 'u_tax_street','placeholder' => 'Calle'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('outdoor_number','Número Exterior')}}
                                {{ Form::text('outdoor_number',null,['class' => 'form-control','id' => 'u_tax_outdoor_number','placeholder' => 'Número Exterior'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('apartment_number','Número Interior')}}
                                {{ Form::text('apartment_number',null,['class' => 'form-control','id' => 'u_tax_apartment_number','placeholder' => 'Número Interior'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('postal_code','Código Postal')}}
                                {{ Form::select('postal_code', ['null'=>'---Seleccionar Código Postal---'] ,null, ['class' => 'form-control','id'=>'u_tax_postal_code']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('colony','Colonia')}}
                                {{ Form::select('colony', [''=>'---Seleccionar Colonia---'] ,null, ['class' => 'form-control','id'=>'u_tax_colony', 'disabled' => 'disabled']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('town','Municipio')}}
                                {{ Form::text('town',null,['class' => 'form-control','id' => 'u_tax_town','placeholder' => 'Municipio', 'disabled' => 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('locality','Localidad')}}
                                {{ Form::text('locality',null,['class' => 'form-control','id' => 'u_tax_locality','placeholder' => 'Localidad'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('state','Estado')}}
                                {{ Form::text('state',null,['class' => 'form-control','id' => 'u_tax_state','placeholder' => 'Estado', 'disabled' => 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('country','País')}}
                                {{ Form::text('country',null,['class' => 'form-control','id' => 'u_tax_country','placeholder' => 'País', 'disabled' => 'disabled'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('tax_email','Email Fiscal')}}
                                {{ Form::email('tax_email',null,['class' => 'form-control','id' => 'u_tax_tax_email','placeholder' => 'Email Fiscal'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('legal_representative','Representante Legal')}}
                                {{ Form::text('legal_representative',null,['class' => 'form-control','id' => 'u_tax_legal_representative','placeholder' => 'Representante Legal'])}}
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


            <!-- Modal for tax data -->
            <div class="modal fade" id="taxDataModal" tabindex="-1" role="dialog" aria-labelledby="addCustomer">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="datos_fiscales_titulo"></h4>
                        </div>
                        <div class="modal-body">
                            <div id="datos_fiscales">
                            </div>                        
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
                        <th>Empresa</th>
                        <th>Contacto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="clientes">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var createRoute = '{{ action('customerController@postCreate'); }}';
var readRoute = '{{ action('customerController@postRead'); }}';
var updateRoute = '{{ action('customerController@postUpdate'); }}';
var deleteRoute = '{{ action('customerController@postDelete'); }}';
var readAllRoute = '{{ action('customerController@postReadAll'); }}';
var readPostalCodesRoute = '{{ action('customerController@postReadPostalCodes'); }}';
var readAddressData = '{{ action('customerController@postReadAddressData'); }}';
var readfiscalData = '{{ action('customerController@postReadFiscalData'); }}';
</script>
<script src="{{ asset("assets/scripts/customer_ajax.js") }}" type="text/javascript"></script>

@stop