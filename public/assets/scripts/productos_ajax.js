    function loadTable(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url:   readAllRoute,
            type:  'post',
            success:  function (msg) {
                $("#productos").html('');
                if (msg !== null && $.isArray(msg) && msg.length>0){
                    $.each(msg, function(index, value){
                        $("#productos").append('<tr class="gradeX"><td>' + value.pro_id + '</td><td>' + value.pro_media + '</td><td>' + value.pro_description + '</td><td>' + value.pro_outlay + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+ value.pro_id +')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="deleteProduct('+ value.pro_id +')">Elminar</button></div></td></tr>');
                    });
                }else{
                    $("#productos").append('<tr class="gradeX"><td colspan="5">No existen productos registrados en la base de datos</td>');
                }
            }
        });
}

function deleteProduct(id){
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
            loadTable();
        }
    });
}

function modalUpdate(id){  
    $('#u_pro_id').val(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        data:   {'id' : id},
        url:   readRoute,
        type:  'post',
        success:  function (msg) {
            $('#u_pro_media').val(msg['pro_media']);
            $('#u_pro_description').val(msg['pro_description']);
            $('#u_pro_outlay').val(msg['pro_outlay']);
            $('#updateProduct').modal('show');
        }
    });        
               
}

var button = document.getElementById("createProduct");
button.addEventListener('click', function(){

    var values = {
        "pro_media" : $('#pro_media').val(),
        "pro_description" : $('#pro_description').val(),
        "pro_outlay" : $('#pro_outlay').val()
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
            if (msg.indexOf("Producto registrado") !== - 1){
                loadTable();
                $('#addProduct').modal('hide');
                $(':input', '#agregarProducto')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
            }                                
        }
    });
});       

var button2 = document.getElementById("updateProductbutton");
button2.addEventListener('click', function(){
    var values = {
        "u_pro_id" : $('#u_pro_id').val(),
        "u_pro_media" : $('#u_pro_media').val(),
        "u_pro_description" : $('#u_pro_description').val(),
        "u_pro_outlay" : $('#u_pro_outlay').val()
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
            if(msg.indexOf("Producto actualizado") !== -1){
                $('#updateProduct').modal('hide');
                loadTable();
                $(':input', '#modificarProducto')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');                             
            }
        }
    });
});

$(document).ready(function(){
    loadTable();
});