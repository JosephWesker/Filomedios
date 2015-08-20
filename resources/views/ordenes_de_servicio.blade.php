@extends('layouts.dashboard')
@section('page_heading','Órdenes de Servicio')
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
                                        <h1>Datos del cliente</h1> 
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
                                                            <h4 class="modal-title" id="addCustomer">Agregar Cliente</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ Form::open(array('url' => '')) }} 
                                                            <h3><b>Datos Generales</b></h3>
                                                            <hr>
                                                            <div class="form-group">
                                                                {{ Form::label('commercialName','Nombre Comercial')}}
                                                                {{ Form::text('commercialName',null,['class' => 'form-control','id' => 'commercialName','placeholder' => 'Nombre Comercial'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('contact','Contacto')}}
                                                                {{ Form::text('contact',null,['class' => 'form-control','id' => 'contact','placeholder' => 'Contacto'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('address','Dirección')}}
                                                                {{ Form::text('address',null,['class' => 'form-control','id' => 'address','placeholder' => 'Dirección'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('phone','Teléfono Fijo')}}
                                                                {{ Form::text('phone',null,['class' => 'form-control','id' => 'phone','placeholder' => 'Teléfono Fijo'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('cellphoneOrNextel','Celular o Nextel')}}
                                                                {{ Form::text('cellphoneOrNextel',null,['class' => 'form-control','id' => 'cellphone','placeholder' => 'Celular o Nextel'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('email','Email')}}
                                                                {{ Form::email('email',null,['class' => 'form-control','id' => 'email','placeholder' => 'Email'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('job','Puesto')}}
                                                                <!--  {{ Form::select('age', ['','Vendedor'],null, ['class' => 'form-control']) }}-->
                                                                {{ Form::text('job',null,['class' => 'form-control','id' => 'job','placeholder' => 'Puesto'])}}
                                                            </div>
                                                            <div class="form-group"> 
                                                                {{ Form::label('businessName','Razón Social')}}
                                                                {{ Form::text('businessName',null,['class' => 'form-control','id' => 'businessName','placeholder' => 'Razón Social'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('rfc','RFC')}}
                                                                {{ Form::text('rfc',null,['class' => 'form-control','id' => 'rfc','placeholder' => 'RFC'])}}
                                                            </div>
                                                            <h3><b>Dirección Fiscal</b></h3>
                                                            <hr>
                                                            <div class="form-group">
                                                                {{ Form::label('street','Calle')}}
                                                                {{ Form::text('street',null,['class' => 'form-control','id' => 'street','placeholder' => 'Calle'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('outsideNumber','Número Exterior')}}
                                                                {{ Form::text('outsideNumber',null,['class' => 'form-control','id' => 'outsideNumber','placeholder' => 'Número Exterior'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('insideNumber','Número Interior')}}
                                                                {{ Form::text('insideNumber',null,['class' => 'form-control','id' => 'insideNumber','placeholder' => 'Número Interior'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('postCode','Código Postal')}}
                                                                {{ Form::text('postCode',null,['class' => 'form-control','id' => 'postCode','placeholder' => 'Código Postal'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('cologne','Colonia')}}
                                                                {{ Form::text('cologne',null,['class' => 'form-control','id' => 'cologne','placeholder' => 'Colonia'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('town','Municipio')}}
                                                                {{ Form::text('town',null,['class' => 'form-control','id' => 'town','placeholder' => 'Municipio'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('locality','Localidad')}}
                                                                {{ Form::text('locality',null,['class' => 'form-control','id' => 'locality','placeholder' => 'Localidad'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('state','Estado')}}
                                                                {{ Form::text('state',null,['class' => 'form-control','id' => 'state','placeholder' => 'Estado'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('country','País')}}
                                                                {{ Form::text('country',null,['class' => 'form-control','id' => 'country','placeholder' => 'País'])}}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('emailProsecutor','Email Fiscal')}}
                                                                {{ Form::email('emailProsecutor',null,['class' => 'form-control','id' => 'emailProsecutor','placeholder' => 'Email Fiscal'])}}
                                                            </div>
                                                            <div class=text-right>
                                                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                                                {{ Form::button('Aceptar',['class' => 'btn btn-success']) }}
                                                            </div>
                                                            {{ Form::close() }}                        
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <table class="table table-striped table-hover table-bordered margin-top20">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
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
                                                <tbody>
                                                    <tr class="gradeX">
                                                        <th></th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <h1>Datos de producción</h1>
                                        <div class="step-content offset" style="position: relative;">

                                            <form class="form-horizontal">

                                                <h3 class="titles">Fechas de transmisión</h3>
                                                <hr>
                                                <div class="input_fields_wrap_date">
                                                    <div class="form-group form-group-sm" style="margin-bottom: 10px!important; display: inline-block; width: 80%;">
                                                        <label class="col-sm-1 control-label" for="formGroupInputSmall">Inicia</label>
                                                        <div class="col-sm-3">
                                                            <div class="">
                                                                <div>
                                                                    <input class="form-control" id="input-multi" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <label class="col-sm-1 control-label" for="formGroupInputSmall">Termina</label>
                                                        <div class="col-sm-3">
                                                            <div class="">
                                                                <div>
                                                                    <input class="form-control" id="input-multi" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <a href="#">
                                                            <i class="fa fa-plus-square add_field_button_date" style="float: left; margin-left: 0; cursor: pointer; font-size: 30px; color: green;">
                                                            </i>
                                                        </a>
                                                    </div>

                                                </div>


                                            </form>
                                        </div>

                                        <h1>Subir archivo</h1>
                                        <div class="step-content" style="position: relative; padding: 0; width: 100%;">




                                            <form id="my-awesome-dropzone" class="dropzone" action="form_file_upload.html#">
                                                <div class="dropzone-previews"></div>
                                                <button type="submit" class="btn btn-primary pull-right">Subir archivos</button>
                                            </form>
                                            <div>
                                                <!-- WESKER EDITADO <div class="m text-right"><small>DropzoneJS is an open source library that provides drag'n'drop file uploads with image previews: <a href="https://github.com/enyo/dropzone" target="_blank">https://github.com/enyo/dropzone</a></small> </div>-->
                                            </div>

                                        </div>

                                        <h1>Pago</h1>


                                        <div class="step-content offset" style="position: relative;">
                                            <form class="form-horizontal">
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Forma de pago</label>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Seleccionar<span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Efectivo</a></li>
                                                            <li><a href="#">Cheque</a></li>
                                                            <li><a href="#">Tarjeta de Crédito</a></li>
                                                            <li><a href="#">Pagaré</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Método de pago</label>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Seleccionar<span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Contado</a></li>
                                                            <li><a href="#">Crédito</a></li>
                                                            <li><a href="#">Abonos</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Últimos 4 dígitos cuenta que paga</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Representante legal</label>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Duración del contrato</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Total de impactos</label>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Seleccionar<span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">1</a></li>
                                                            <li><a href="#">2</a></li>
                                                            <li><a href="#">3</a></li>
                                                            <li><a href="#">4</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Impactos al mes</label>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Seleccionar<span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">1</a></li>
                                                            <li><a href="#">2</a></li>
                                                            <li><a href="#">3</a></li>
                                                            <li><a href="#">4</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Impactos por hora</label>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Seleccionar<span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">1</a></li>
                                                            <li><a href="#">2</a></li>
                                                            <li><a href="#">3</a></li>
                                                            <li><a href="#">4</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Importe total contratado C/IVA $</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Importes y fechas de pago</label>
                                                    <div class="col-sm-4">
                                                        <div class="input_fields_wrap">
                                                            <div>
                                                                <input class="form-control" id="input-multi" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]">
                                                                <i class="fa fa-plus-square add_field_button" style="float: right; margin-left: 10px; cursor: pointer; font-size: 30px; color: green;">
                                                                </i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Recibí la cantidad de $</label>
                                                    <div class="col-sm-4">
                                                        <input class="form-control" type="text">
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

@stop