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
                                    <!-- <div class="ibox-tools">
                                         <a class="collapse-link">
                                             <i class="fa fa-chevron-up"></i>
                                         </a>
                                         <a class="dropdown-toggle" data-toggle="dropdown" href="form_wizard.html#">
                                             <i class="fa fa-wrench"></i>
                                         </a>
                                         <ul class="dropdown-menu dropdown-user">
                                             <li><a href="form_wizard.html#">Config option 1</a>
                                             </li>
                                             <li><a href="form_wizard.html#">Config option 2</a>
                                             </li>
                                         </ul>
                                         <a class="close-link">
                                             <i class="fa fa-times"></i>
                                         </a>
                                     </div>-->
                                </div>
                                <div class="ibox-content">
                                    <!--  <p>
                                          This is basic example of Step
                                      </p>-->
                                    <div id="wizard">
                                        <h1>Datos del cliente</h1>
                                        <div class="step-content offset" style="position: relative; width: 100%;">
                                            <div id="button-container" style="width: 100%; height: 30px;">
                                                <button class="btn btn-primary" style="float: right; margin: 0 22% 0;" type="button"><i></i>&nbsp;Agregar cliente existente</button>
                                            </div>
                                            {{ Form::open(array('url' => url(''),'class'=>'form')) }} 
                                            <h3 class="titles">Datos Generales</h3>
                                            <hr>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Nombre comercial</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text" id="formGroupInputSmall" name="nombre-comercial">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Contacto</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Puesto</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Teléfono</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Celular o Nextel</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Correo electrónico</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Dirección</label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Razón Social</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">RFC</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <h3 class="titles">Dirección Fiscal</h3>
                                            <hr>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Calle</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Número Exterior</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Número interor</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Código Postal</label>
                                                <div class="col-sm-2">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Colonia</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Municipio</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Localidad</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Estado</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">País</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Correo electrónico fiscal</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <h3 class="titles">Solo para ser llenados para cadenas o corporativos</h3>
                                            <hr>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">Número global de localización (GLN)</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">EAN/UPC</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group form-group-sm">
                                                <label class="col-sm-3 control-label" for="formGroupInputSmall">SKU</label>
                                                <div class="col-sm-4">
                                                    <input class="form-control" type="text">
                                                </div>
                                            </div>
                                            </form>
                                        </div>

                                        <h1>Datos de producción</h1>
                                        <div class="step-content offset" style="position: relative;">
                                            <form class="form-horizontal">
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Duración del spot</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Producción filomedios</label>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Seleccionar<span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">Si</a></li>
                                                            <li><a href="#">No</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Entregado en Formato</label>
                                                    <div class="btn-group">
                                                        <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle">Seleccionar<span class="caret"></span></button>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">MPG 1</a></li>
                                                            <li><a href="#">MPG 2</a></li>
                                                            <li><a href="#">MOV</a></li>
                                                            <li><a href="#">AVI</a></li>
                                                            <li><a href="#">MP4</a></li>
                                                            <li><a href="#">FLV</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Archivos recibidos</label>
                                                    <div class="col-sm-4">
                                                        <div class="input_fields_wrap-2">
                                                            <div><input class="form-control input-multi" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="text" name="mytext[]"><i class="fa fa-plus-square add_field_button-2" style="float: right; margin-left: 10px; cursor: pointer; font-size: 30px; color: green;"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Fecha de grabación</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <h3 class="titles">Fechas de propuesta</h3>
                                                <hr>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Primera</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Segunda</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <h3 class="titles">Fechas de transmisión</h3>
                                                <hr>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Inicia</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Termina</label>
                                                    <div class="col-sm-2">
                                                        <input class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="form-group form-group-sm">
                                                    <label class="col-sm-3 control-label" for="formGroupInputSmall">Observaciones</label>
                                                    <div class="col-sm-7">
                                                        <textarea rows="4" cols="50"></textarea>
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
                                                            <div><input class="form-control" id="input-multi" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]"><i class="fa fa-plus-square add_field_button" style="float: right; margin-left: 10px; cursor: pointer; font-size: 30px; color: green;"></i></div>
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