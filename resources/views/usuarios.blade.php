@extends('layouts.dashboard')
@section('page_heading','Usuarios')
@section('section')
<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addUser">
                Agregar Usuario
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '', 'id' => 'agregarUsuario')) }}
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'emp_first_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('lastName','Apellido')}}
                                {{ Form::text('lastName',null,['class' => 'form-control','id' => 'emp_last_names','placeholder' => 'Apellido'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('address','Dirección')}}
                                {{ Form::text('address',null,['class' => 'form-control','id' => 'emp_address','placeholder' => 'Dirección'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('phone','Teléfono Fijo')}}
                                {{ Form::text('phone',null,['class' => 'form-control','id' => 'emp_phone_number','placeholder' => 'Teléfono Fijo'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('cellphone','Celular')}}
                                {{ Form::text('cellphone',null,['class' => 'form-control','id' => 'emp_cellphone_number','placeholder' => 'Celular'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email','Email')}}
                                {{ Form::email('email',null,['class' => 'form-control','id' => 'emp_email','placeholder' => 'Email'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('job','Puesto')}}
                                {{ Form::select('age', ['vendedor'=>'Vendedor'],null, ['class' => 'form-control','id'=>'emp_job']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('userName','Nombre de Usuario')}}
                                {{ Form::text('userName',null,['class' => 'form-control','id' => 'emp_username','placeholder' => 'Nombre de Usuario'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password','Contraseña')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'emp_password','placeholder' => 'Contraseña'])}}
                            </div>

                            <div class=text-right>
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss'=> "modal"]) }}
                                {{ Form::button('Aceptar',['class' => 'btn btn-success', 'id' => 'createUser']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Update -->
            <div class="modal fade" id="updateUser" tabindex="-1" role="dialog" aria-labelledby="addUserLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modificar Usuario</h4>
                        </div>
                        <div class="modal-body">
                            {{ Form::open(array('url' => '', 'id' => 'modificarUsuario')) }}
                            {{ Form::hidden ('id',null,['id' => 'u_emp_id']) }}
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'u_emp_first_name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('lastName','Apellido')}}
                                {{ Form::text('lastName',null,['class' => 'form-control','id' => 'u_emp_last_names','placeholder' => 'Apellido'])}}
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
                                {{ Form::label('email','Email')}}
                                {{ Form::email('email',null,['class' => 'form-control','id' => 'u_emp_email','placeholder' => 'Email'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('job','Puesto')}}
                                {{ Form::select('age', ['vendedor'=>'Vendedor'],null, ['class' => 'form-control','id'=>'u_emp_job']) }}
                            </div>
                            <div class=text-right>
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss'=> "modal"]) }}
                                {{ Form::button('Aceptar',['class' => 'btn btn-success', 'id' => 'updateUserbutton']) }}
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-12">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dirección</th>
                        <th>Telefono Fijo</th>
                        <th>Celular</th>
                        <th>Email</th>
                        <th>Puesto</th>
                        <th>Nombre de Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="usuarios">                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
    function loadTable(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url:   '{{ action('employeeController@postShowEmployees'); }}',
            type:  'post',
            success:  function (msg) {
                $("#usuarios").html('');
                if (msg != null && $.isArray(msg)){
                    $.each(msg, function(index, value){
                        $("#usuarios").append('<tr class="gradeX"><td>' + value.emp_id + '</td><td>' + value.emp_first_name + '</td><td>' + value.emp_last_names + '</td><td>' + value.emp_address + '</td><td>' + value.emp_phone_number + '</td><td>' + value.emp_cellphone_number + '</td><td>' + value.emp_email + '</td><td>' + value.emp_job + '</td><td>' + value.emp_username + '</td><td><button class="btn btn-warning btn-xs" type="button" onclick="modalUpdate('+ value.emp_id +')">Editar</button><button class="btn btn-danger btn-xs" type="button" onclick="deleteUser('+ value.emp_id +')">Elminar</button></td></tr>');
                    });
                }else{
                    $("#usuarios").append('<tr class="gradeX"><td>' + value.emp_id + '</td>');
                }
           }
        });
    }
    
    function deleteUser(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            data: {'id' : id },
            url:   '{{ action('employeeController@postDelateEmployee'); }}',
            type:  'post',
            success:  function (msg) {
                alert(msg);
                $("#usuarios").empty();
                loadTable();
            }
        });
    }
    
    $(document).ready(function(){
        loadTable();
    });
    var button = document.getElementById("createUser");
    button.addEventListener('click', function(){

        var values = {
            "emp_first_name" : $('#emp_first_name').val(),
            "emp_last_names" : $('#emp_last_names').val(),
            "emp_address" : $('#emp_address').val(),
            "emp_phone_number" : $('#emp_phone_number').val(),
            "emp_cellphone_number" : $('#emp_cellphone_number').val(),
            "emp_email" : $('#emp_email').val(),
            "emp_job" : $('#emp_job').val(),
            "emp_username" : $('#emp_username').val(),
            "emp_password" : $('#emp_password').val()
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            data:   values,
            url:   '{{ action('employeeController@postCreateEmployee'); }}',
            type:  'post',
            success:  function (msg) {
                alert(msg);
                if (msg.indexOf("Usuario registrado") != - 1){
                    $("#usuarios").empty();
                    loadTable();
                    $('#addUser').modal('hide');
                    $(':input', '#agregarUsuario')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .removeAttr('checked')
                        .removeAttr('selected');
                }                                
            }
        });
    });
    
    function modalUpdate(id){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            data: {'id' : id },
            url:   '{{ action('employeeController@postGetEmployee'); }}',
            type:  'post',
            success:  function (msg) {
                $('#u_emp_id').val(msg['emp_id']);
                $('#u_emp_first_name').val(msg['emp_first_name']),
                $('#u_emp_last_names').val(msg['emp_last_names']),
                $('#u_emp_address').val(msg['emp_address']),
                $('#u_emp_phone_number').val(msg['emp_phone_number']),
                $('#u_emp_cellphone_number').val(msg['emp_cellphone_number']),
                $('#u_emp_email').val(msg['emp_email']),
                $('#u_emp_job').val(msg['emp_job']),
                $('#updateUser').modal('show');
           }
        });
    }
    
    var button2 = document.getElementById("updateUserbutton");
    button2.addEventListener('click', function(){
        var values = {
            "emp_id" : $('#u_emp_id').val(),
            "emp_first_name" : $('#u_emp_first_name').val(),
            "emp_last_names" : $('#u_emp_last_names').val(),
            "emp_address" : $('#u_emp_address').val(),
            "emp_phone_number" : $('#u_emp_phone_number').val(),
            "emp_cellphone_number" : $('#u_emp_cellphone_number').val(),
            "emp_email" : $('#u_emp_email').val(),
            "emp_job" : $('#u_emp_job').val(),
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            data:   values,
            url:   '{{ action('employeeController@postUpdateEmployee'); }}',
            type:  'post',
            success:  function (msg) {
                alert(msg);
                $("#usuarios").empty();
                loadTable();
                $('#updateUser').modal('hide');
                $(':input', '#modificarUsuario')
                    .not(':button, :submit, :reset, :hidden')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');                             
            }
        });
    });
</script>
@stop