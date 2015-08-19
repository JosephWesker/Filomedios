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
                            {{ Form::open(array('url' => '')) }} 
                            <div class="form-group">
                                {{ Form::label('name','Nombre')}}
                                {{ Form::text('name',null,['class' => 'form-control','id' => 'name','placeholder' => 'Nombre'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('lastName','Apellido')}}
                                {{ Form::text('lastName',null,['class' => 'form-control','id' => 'lastName','placeholder' => 'Apellido'])}}
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
                                {{ Form::label('cellphone','Celular')}}
                                {{ Form::text('cellphone',null,['class' => 'form-control','id' => 'cellphone','placeholder' => 'Celular'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('email','Email')}}
                                {{ Form::email('email',null,['class' => 'form-control','id' => 'email','placeholder' => 'Email'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('job','Puesto')}}
                                <!--                                {{ Form::text('job',null,['class' => 'form-control','id' => 'job','placeholder' => 'Puesto'])}}-->
                                {{ Form::select('age', ['','Vendedor'],null, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('userName','Nombre de Usuario')}}
                                {{ Form::text('userName',null,['class' => 'form-control','id' => 'userName','placeholder' => 'Nombre de Usuario'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password','Contraseña')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'password','placeholder' => 'Contraseña'])}}
                            </div>

                            <div class=text-right>
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger']) }}
                                {{ Form::button('Aceptar',['class' => 'btn btn-success']) }}
                            </div>
                            {{ Form::close() }}                        
                        </div>
                        <!--                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                                </div>-->
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-12">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono Fijo</th>
                        <th>Celular</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Puesto</th>
                        <th>Nombre de Usuario</th>
                        <th>Acciones</th>
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
                        <td>
                                {{ Form::button('Editar',['class' => 'btn btn-warning btn-xs']) }}
                                {{ Form::button('Elminar',['class' => 'btn btn-danger btn-xs']) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
var button = document.getElementById("crearUsuario");
button.addEventListener('click',function(){

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
                    if(msg.indexOf("Usuario registrado") != -1){
                        $('#addUser').modal('hide');
                        $(':input','#agregarUsuario')
                          .not(':button, :submit, :reset, :hidden')
                          .val('')
                          .removeAttr('checked')
                          .removeAttr('selected');
                    }
                        alert(msg);
                    }
            });
});
</script>
@stop