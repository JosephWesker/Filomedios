    function loadTable(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url:   showEmployeesRoute,
            type:  'post',
            success:  function (msg) {
                $("#usuarios").html('');
                if (msg !== null && $.isArray(msg) && msg.length>0){
                    $.each(msg, function(index, value){
                        $("#usuarios").append('<tr class="gradeX"><td>' + value.use_id + '</td><td>' + value.use_username + '</td><td><button class="btn btn-warning btn-xs" type="button" onclick="modalUpdate('+ value.use_id +')">Cambiar contraseña</button><button class="btn btn-danger btn-xs" type="button" onclick="deleteUser('+ value.use_id +')">Eliminar</button></td></tr>');
                    });
                }else{
                    $("#usuarios").append('<tr class="gradeX"><td colspan="3">No existen usuarios registrados en la base de datos</td>');
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
            url:   delateRoute,
            type:  'post',
            success:  function (msg) {
                alert(msg);
                $("#usuarios").empty();
                loadTable();
            }
        });
    }
    
    function modalUpdate(id){  
        $('#u_use_id').val(id);
        $('#updateUser').modal('show');           
    }
    
    $(document).ready(function(){
        loadTable();
    });
    
    var button = document.getElementById("createUser");
    button.addEventListener('click', function(){

        var values = {
            "use_username" : $('#use_username').val(),
            "use_password" : $('#use_password').val(),
            "repetir_use_password" : $('#repetir_use_password').val(),
        };
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            data:   values,
            url:   createRoute,
            type:  'post',
            success:  function (msg) {
                alert(msg);
                if (msg.indexOf("Usuario registrado") !== - 1){
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
    
    var button2 = document.getElementById("updateUserbutton");
    button2.addEventListener('click', function(){
        var values = {
            "use_id" : $('#u_use_id').val(),
            "ant_u_use_password" : $('#ant_u_use_password').val(),
            "new_u_use_password" : $('#new_u_use_password').val(),
            "rep_u_use_password" : $('#rep_u_use_password').val(),
        };
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            data:   values,
            url:   updateRoute,
            type:  'post',
            success:  function (msg) {
                alert(msg);
                if(msg.indexOf("Contraseña actualizada") !== -1){
                    $("#usuarios").empty();
                    $('#updateUser').modal('hide');
                    $(':input', '#modificarUsuario')
                        .not(':button, :submit, :reset, :hidden')
                        .val('')
                        .removeAttr('checked')
                        .removeAttr('selected');                             
                }
            }
        });
    });


