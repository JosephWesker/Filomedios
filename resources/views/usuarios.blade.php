@extends('layouts.dashboard')
@section('page_heading','Empleados')
@section('section')

<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#add">
                Agregar Empleado
            </button>

            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#customerschange">
                Traspasar clientes
            </button>

            <!-- Modal -->
            <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addBusinessUnit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Agregar Empleado</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'emp_first_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('lastName','Apellidos')}}
                                {{ Form::text('lastName',null,['class' => 'form-control','id' => 'emp_last_name','placeholder' => 'Apellido'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('address','Dirección')}}
                                {{ Form::text('address',null,['class' => 'form-control','id' => 'emp_address','placeholder' => 'Dirección'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('phone','Teléfono Fijo')}}
                                {{ Form::number('phone',null,['class' => 'form-control','id' => 'emp_phone_number','placeholder' => 'Teléfono Fijo'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('cellphone','Celular')}}
                                {{ Form::number('cellphone',null,['class' => 'form-control','id' => 'emp_cellphone_number','placeholder' => 'Celular'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('job','Puesto')}}
                                {{ Form::select('job', ['vendedor'=>'Vendedor','administrador'=>'Administrador','producción'=>'Producción','tesoreria' => 'Tesoreria', 'gerente de ventas'=>'Gerente de Ventas'],null,['class' => 'form-control','id'=>'emp_job']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('fk_business_unit','Unidad de Negocio')}}
                                {{ Form::select('fk_business_unit', ['null'=>'---Seleccionar unidad de negocio---'],null,['class' => 'form-control','id'=>'emp_fk_business_unit']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email','Correo Electronico')}}
                                {{ Form::email('email',null,['class' => 'form-control','id' => 'emp_email','placeholder' => 'Correo Electronico'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password','Contraseña')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'emp_password','placeholder' => 'Contraseña'])}}
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

            <!-- Modal for Change Customers -->
            <div class="modal fade" id="customerschange" tabindex="-1" role="dialog" aria-labelledby="updateBusinessUnit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Traspasar clientes</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'actualizar')) }}                             
                            <div class="form-group">
                                {{ Form::label('employee','Empleado a cambiar clientes')}}
                                {{ Form::select('employee', [],null,['class' => 'form-control','id'=>'employee_old','onchange' => 'checkEmployee()']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('employee','Empleado a recibir clientes')}}
                                {{ Form::select('employee', [],null,['class' => 'form-control','id'=>'employee_new']) }}
                            </div>
                            <div class="checkbox">
                                    <label>
                                        {{ Form::checkbox('program', '1', null, ['class' => '','id' => 'employee_change_all','onclick' => 'setallselect()' ])}} Todos
                                    </label>
                                </div>
                            <div class="col-lg-12 table-responsive">
                                <table class="table table-striped table-hover table-bordered margin-top20">
                                    <thead>
                                        <tr>
                                            <th>Traspasar</th>
                                            <th>Nombre</th>
                                            <th>Empresa</th>
                                            <th>Contacto</th>
                                        </tr>
                                    </thead>
                                    <tbody id="clientes">
                                    </tbody>
                                </table>
                            </div>                        
                            <div class=text-right>
                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'changeCustomers()','id' => 'changecustomers']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                            </div>
                            {{ Form::close() }}                        
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Update -->
            <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateBusinessUnit">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Modificar Empleado</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '#', 'id' => 'actualizar')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'u_emp_first_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('lastName','Apellidos')}}
                                {{ Form::text('lastName',null,['class' => 'form-control','id' => 'u_emp_last_name','placeholder' => 'Apellido'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('address','Dirección')}}
                                {{ Form::text('address',null,['class' => 'form-control','id' => 'u_emp_address','placeholder' => 'Dirección'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('phone','Teléfono Fijo')}}
                                {{ Form::number('phone',null,['class' => 'form-control','id' => 'u_emp_phone_number','placeholder' => 'Teléfono Fijo'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('cellphone','Celular')}}
                                {{ Form::number('cellphone',null,['class' => 'form-control','id' => 'u_emp_cellphone_number','placeholder' => 'Celular'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('job','Puesto')}}
                                {{ Form::select('job', ['vendedor'=>'Vendedor','administrador'=>'Administrador','producción'=>'Producción','tesoreria' => 'Tesoreria', 'gerente de ventas'=>'Gerente de Ventas'],null,['class' => 'form-control','id'=>'u_emp_job']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('fk_business_unit','Unidad de Negocio')}}
                                {{ Form::select('fk_business_unit', ['null'=>'---Seleccionar unidad de negocio---'],null,['class' => 'form-control','id'=>'u_emp_fk_business_unit']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email','Correo Electronico')}}
                                {{ Form::email('email',null,['class' => 'form-control','id' => 'u_emp_email','placeholder' => 'Correo Electronico'])}}
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

        <div class="col-lg-12 table-responsive">
            <table class="table table-striped table-hover table-bordered margin-top20">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Teléfonos</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="empleados">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var createRoute = '{{ action('employeeController@postCreate'); }}';
var readRoute = '{{ action('employeeController@postRead'); }}';
var updateRoute = '{{ action('employeeController@postUpdate'); }}';
var deleteRoute = '{{ action('employeeController@postDelete'); }}';
var readAllRoute = '{{ action('employeeController@postReadAll'); }}';
var readCustomersRoute = '{{ action('customerController@postGetByEmployee'); }}';
var updateCustomersRoute = '{{ action('customerController@postChangeEmployee'); }}';
var loadBusinessUnitRoute = '{{ action('employeeController@postLoadBusinessUnit'); }}';
</script>
<script src="{{ asset("assets/scripts/employee_ajax.js") }}" type="text/javascript"></script>

@stop