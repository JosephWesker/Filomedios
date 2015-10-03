var id = '';

function create(){
    var data = {
        "sho_name" : $('#sho_name').val(),
        "sho_description" : $('#sho_description').val()
    };

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    url:   createRoute,
    data: data,
    type:  'post',
    success:  function (data) {
        alert(data.data);
        loadTable();
        $('#add').modal('hide');
        $(':input', '#agregar')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');        
    }
});
}

function read(id){
    var data = {
        "id" : id,
    };

   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $.ajax({
    url:   readRoute,
    data: data,
    type:  'post',
    success:  function (data) {
        $('#u_sho_name').val(data.data['sho_name']);
        $('#u_sho_description').val(data.data['sho_description']); 
        $('#updateModal').modal('show');   
    }
});
}

function update(){
    var data = {
        "id" : this.id,
        "sho_name" : $('#u_sho_name').val(),
        "sho_description" : $('#u_sho_description').val()
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   updateRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert(data.data);
            loadTable();
            $('#updateModal').modal('hide'); 
            $(':input', '#actualizar')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected')
        }
    });
}

function delet(id){
    var data = {
        "id" : id,
    };

   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $.ajax({
    url:   deleteRoute,
    data: data,
    type:  'post',
    success:  function (data) {
        alert(data.data);
        loadTable();
    }
});
}

function loadTable(){
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $.ajax({
    url:   readAllRoute,
    type:  'post',
    success:  function (data) {
        $("#unidades_negocio").html('');
        if (data.data !== null && $.isArray(data.data) && data.data.length>0){
            $.each(data.data, function(index, value){
                $("#unidades_negocio").append('<tr class="gradeX"><td>' + value.sho_id + '</td><td>' + value.sho_name + '</td><td>' + value.sho_description + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+ value.sho_id +')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('+ value.sho_id +')">Elminar</button></div></td></tr>');
            });
        }else{
            $("#unidades_negocio").append('<tr class="gradeX"><td colspan="4">No existen Programas registradas en la base de datos</td>');
        }
    }
});
}

function modalUpdate(id){  
    this.id = id;
    read(id);                   
}

$(document).ready(function(){
    loadTable();
});