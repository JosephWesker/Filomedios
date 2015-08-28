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
                                                                <!--  {{ Form::select('age', ['','Vendedor'],null, ['class' => 'form-control']) }}-->
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
                                                                {{ Form::label('businessName','Razón Social')}}
                                                                {{ Form::text('businessName',null,['class' => 'form-control','id' => 'cus_business_name','placeholder' => 'Razón Social'])}}
                                                            </div>                                                            
                                                            <div class="form-group">
                                                                {{ Form::label('sellet','Vendedor Asignado')}}
                                                                {{ Form::select('age', [] ,null, ['class' => 'form-control','id'=>'cus_fk_employee']) }}
                                                            </div>
                                                            <h3><b>Datos Fiscales</b></h3>
                                                            <hr>
                                                            <div class="form-group">
                                                                {{ Form::label('rfc','RFC')}}
                                                                {{ Form::text('rfc',null,['class' => 'form-control','id' => 'tax_rfc','placeholder' => 'RFC'])}}
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
                                            <table class="table table-striped table-hover table-bordered margin-top20">
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




                                            <input type="checkbox" name="tabs-1" value="1">Spots 
                                            <input type="checkbox" name="tabs-2" value="2">Cintillos 
                                            <input type="checkbox" name="tabs-3" value="3">Programas
                                            <input type="checkbox" name="tabs-4" value="4">Portal Noticias
                                            <br>
                                            <div id="tabs">
                                                <ul>
                                                    <li><a href="#tabs-1">Spots</a> </li>
                                                    <li><a href="#tabs-2">Cintillos</a></li>
                                                    <li><a href="#tabs-3">Programas</a></li>
                                                    <li><a href="#tabs-4">Portal Noticias</a></li>
                                                </ul>
                                                <div id="tabs-1">
                                                    <h3>Spots</h3>


                                                    <div class="col-sm-5">
                                                        <div class="">
                                                            <div>
                                                                <div id="hey"></div>
                                                                <div id="huy"></div>
                                                                <input id="1" type="text" name="fname"><br>
                                                                <input id="2" type="text" name="fname"><br>
                                                                <script>
                                                                    var now = moment();
                                                                            var x = document.getElementById("1").value;
                                                                            var y = document.getElementById("2").value;
                                                                            z = x + y;
                                                                            document.getElementById("huy").innerHTML = z;
                                                                            
//                                                                            var date = moment(now).format('DD/MM/YYYY');
//                                                                            document.getElementById("hey").innerHTML = date;

//                                                                            var x = document.getElementById("payment-2").value;
//                                                                            document.getElementById("huy").innerHTML = x;
//                                                                            var months = moment().diff('2000/01/01', 'months');
//                                                                            document.getElementById("hey").innerHTML = months;                                                                </script>
                                                                <input class="form-control" id="payment-2" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]">

                                                            </div>
                                                        </div>
                                                    </div>




                                                </div>
                                                <div id="tabs-2">
                                                    <h3>Cintillos</h3>
                                                </div>
                                                <div id="tabs-3">
                                                    <h3>Programas</h3>
                                                </div>
                                                <div id="tabs-4">
                                                    <h3>Portal Noticias</h3>
                                                </div>
                                            </div>









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
                                                                            var showEmployeesSelectRoute = '{{ action('employeeController@postShowEmployeesSelect'); }}';
                                                                            var createCustomerRoute = '{{ action('customerController@postCreateCustomer'); }}';</script>
<script src="{{ asset("assets/scripts/orden_de_servicio_ajax.js") }}" type="text/javascript"></script>
@stop