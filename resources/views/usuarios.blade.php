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
                            <form id="agregarUsuario">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="emp_first_name" placeholder="Nombre">
                                </div>
                                <div class="form-group">
                                    <label for="lastName">Apellido</label>
                                    <input type="text" class="form-control" id="emp_last_names" placeholder="Apellido">
                                </div>
                                <div class="form-group">
                                    <label for="address">Dirección</label>
                                    <input type="text" class="form-control" id="emp_address" placeholder="Dirección">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Teléfono Fijo</label>
                                    <input type="tel" class="form-control" id="emp_phone_number" placeholder="Teléfono Fijo">
                                </div>
                                <div class="form-group">
                                    <label for="cellphone">Teléfono Móvil</label>
                                    <input type="tel" class="form-control" id="emp_cellphone_number" placeholder="Teléfono Móvil">
                                </div>
                                <div class="form-group">
                                    <label for="cellphone">Email</label>
                                    <input type="email" class="form-control" id="emp_email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="job">Puesto</label>
                                    <input type="text" class="form-control" id="emp_job" placeholder="Puesto">
                                </div>
                                <div class="form-group">
                                    <label for="userName">Nombre de Usuario</label>
                                    <input type="text" class="form-control" id="emp_username" placeholder="Nombre de Usuario">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" class="form-control" id="emp_password" placeholder="Contraseña">
                                </div>

                                <div class=text-right>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="button" class="btn btn-success" id="crearUsuario">Aceptar</button>
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