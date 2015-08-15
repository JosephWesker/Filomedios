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
                            <form>
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Apellido</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Apellido">
                                </div>
                                <div class="form-group">
                                    <label for="address">Dirección</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Teléfono Fijo</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Teléfono Fijo">
                                </div>
                                <div class="form-group">
                                    <label for="cellphone">Teléfono Móvil</label>
                                    <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Teléfono Móvil">
                                </div>
                                <div class="form-group">
                                    <label for="cellphone">Email</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="job">Puesto</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Puesto">
                                </div>
                                <div class="form-group">
                                    <label for="userName">Nombre de Usuario</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nombre de Usuario">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                                </div>

                                <div class=text-right>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                </div>
                            </form>                      
                        </div>
                        <!--                        <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-success">Aceptar</button>
                                                </div>-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>@stop