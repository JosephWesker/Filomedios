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
                                {{ Form::label('userName','Correo Electronico')}}
                                {{ Form::text('userName',null,['class' => 'form-control','id' => 'use_username','placeholder' => 'Nombre de Usuario'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password','Contraseña')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'use_password','placeholder' => 'Contraseña'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password','Repetir contraseña')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'repetir_use_password','placeholder' => 'Contraseña'])}}
                            </div>
                            <div class=text-right>
            
                                {{ Form::button('Aceptar',['class' => 'btn btn-success', 'id' => 'createUser']) }}
                                {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss'=> "modal"]) }}
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
                            {{ Form::hidden ('id',null,['id' => 'u_use_id']) }}
                            <div class="form-group">
                                {{ Form::label('password','Contraseña anterior')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'ant_u_use_password','placeholder' => 'Contraseña'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password','Nueva contraseña')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'new_u_use_password','placeholder' => 'Contraseña'])}}
                            </div>
                            <div class="form-group">
                                {{ Form::label('password','Repetir contraseña')}}
                                {{ Form::password('password',['class' => 'form-control','id' => 'rep_u_use_password','placeholder' => 'Contraseña'])}}
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
    var updateRoute = '{{ action('userController@postUpdateUsers'); }}';
    var showEmployeesRoute = '{{ action('userController@postShowUsers'); }}';
    var delateRoute = '{{ action('userController@postDelateUsers'); }}';
    var createRoute = '{{ action('userController@postCreateUsers'); }}';
</script>
<script src="{{ asset("assets/scripts/usuarios_ajax.js") }}"></script>
@stop