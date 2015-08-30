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
                        $("#usuarios").append('<tr class="gradeX"><td>' + value.emp_id + '</td><td>' + value.emp_first_name + '</td><td>' + value.emp_last_names + '</td><td>' + value.emp_address + '</td><td>' + value.emp_phone_number + '</td><td>' + value.emp_cellphone_number + '</td><td>' + value.emp_job + '</td><td>' + value.use_username + '</td><td><button class="btn btn-warning btn-xs" type="button" onclick="modalUpdate('+ value.emp_id +')">Editar</button><button class="btn btn-danger btn-xs" type="button" onclick="deleteUser('+ value.emp_id +')">Elminar</button></td></tr>');
                    });
                }else{
                    $("#usuarios").append('<tr class="gradeX"><td colspan="10">No existen usuarios registrados en la base de datos</td>');
                }
            }
        });
    }
    
    function loadUsers(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url:   showUserSelectRoute,
            type:  'post',
            success:  function (msg) {
                $("#emp_fk_user").html('');
                $("#u_emp_fk_user").html('');
                if (msg !== null && $.isArray(msg) && msg.length>0){
                    $.each(msg, function(index, value){
                        $("#emp_fk_user").append('<option value="'+value.use_id+'">'+value.use_username+'</option>');
                        $("#u_emp_fk_user").append('<option value="'+value.use_id+'">'+value.use_username+'</option>');
                    });
                }else{
                    $("#emp_fk_user").append('<option value="null">No existen Vendedores</option>');
                    $("#emp_fk_user").prop('disabled','disabled');
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
    
    $(document).ready(function(){
        loadTable();
        loadUsers();
    });
    
    var button = document.getElementById("createUser");
    button.addEventListener('click', function(){

        var values = {
            "emp_first_name" : $('#emp_first_name').val(),
            "emp_last_names" : $('#emp_last_names').val(),
            "emp_address" : $('#emp_address').val(),
            "emp_phone_number" : $('#emp_phone_number').val(),
            "emp_cellphone_number" : $('#emp_cellphone_number').val(),
            "emp_job" : $('#emp_job').val(),
            "emp_fk_user" : $('#emp_fk_user').val()
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
                if (msg.indexOf("Empleado registrado") !== - 1){
                    $("#usuarios").empty();
                    loadTable();
                    $('#addUser').modal('hide');
                    $(':input', '#agregarEmpleado')
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
            url:   getEmployeeRoute,
            type:  'post',
            success:  function (msg) {
                $('#u_emp_id').val(msg['emp_id']);
                $('#u_emp_first_name').val(msg['emp_first_name']);
                $('#u_emp_last_names').val(msg['emp_last_names']);
                $('#u_emp_address').val(msg['emp_address']);
                $('#u_emp_phone_number').val(msg['emp_phone_number']);
                $('#u_emp_cellphone_number').val(msg['emp_cellphone_number']);
                $('#u_emp_job').val(msg['emp_job']);
                $('#u_emp_fk_user').val(msg['emp_fk_user']);
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
            "emp_job" : $('#u_emp_job').val(),
            "emp_fk_user" : $('#u_emp_fk_user').val()
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
                $("#usuarios").empty();
                loadTable();
                $('#updateUser').modal('hide');
                $(':input', '#modificarEmpleado')
                    .not(':button, :submit, :reset, :hidden')
                    .val('')
                    .removeAttr('checked')
                    .removeAttr('selected');                             
            }
        });
    });


