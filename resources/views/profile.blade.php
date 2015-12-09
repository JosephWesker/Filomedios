@extends('layouts.dashboard')
@section('page_heading','Modificar Perfil')
@section('section')                    
<div class="col-lg-12">
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
        {{ Form::text('phone',null,['class' => 'form-control','id' => 'u_emp_phone_number','placeholder' => 'Teléfono Fijo'])}}
    </div>
    <div class="form-group">
        {{ Form::label('cellphone','Celular')}}
        {{ Form::text('cellphone',null,['class' => 'form-control','id' => 'u_emp_cellphone_number','placeholder' => 'Celular'])}}
    </div>
    <div class="form-group">
        {{ Form::label('email','Correo Electronico')}}
        {{ Form::email('email',null,['class' => 'form-control','id' => 'u_emp_email','placeholder' => 'Correo Electronico'])}}
    </div>
    <div class="checkbox">
        <label>
            {{ Form::checkbox('duration', '3', null, ['class' => '','id' => 'spy_has_duration'])}} Cambiar contraseña
        </label>
    </div>
    <div id="seconds_duration" class="duration" style="display:none">
        <div class="form-group">
            {{ Form::label('password','Contraseña anterior')}}
            {{ Form::password('password',['class' => 'form-control','id' => 'emp_password','placeholder' => 'Contraseña'])}}
        </div>                           
        <div class="form-group">
            {{ Form::label('password','Nueva Contraseña')}}
            {{ Form::password('password',['class' => 'form-control','id' => 'emp_new_password','placeholder' => 'Contraseña'])}}
        </div>
        <div class="form-group">
            {{ Form::label('password','Confirmar Contraseña')}}
            {{ Form::password('password',['class' => 'form-control','id' => 'emp_rep_password','placeholder' => 'Contraseña'])}}
        </div>
    </div>
    <div class=text-right>
        {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'update()']) }}
    </div>
    {{ Form::close() }}                        
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var id = '{{ Session::get('id'); }}';
var readRoute = '{{ action('employeeController@postRead'); }}';
var updateRoute = '{{ action('employeeController@postUpdateProfile'); }}';
</script>
<script src="{{ asset("assets/scripts/profile_ajax.js") }}" type="text/javascript"></script>            
@stop
