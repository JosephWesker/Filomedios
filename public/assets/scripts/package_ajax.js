var id = '';

function create(){
    var data = {
        "pac_name" : $('#pac_name').val(),
        "pac_description" : $('#pac_description').val()
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
        $('#u_pac_name').val(data.data['pac_name']);
        $('#u_pac_description').val(data.data['pac_description']); 
        $('#updateModal').modal('show');   
    }
});
}

function update(){
    var data = {
        "id" : this.id,
        "pac_name" : $('#u_pac_name').val(),
        "pac_description" : $('#u_pac_description').val()
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
        $("#paquetes").html('');
        if (data.data !== null && $.isArray(data.data) && data.data.length>0){
            $.each(data.data, function(index, value){
                $("#paquetes").append('<tr class="gradeX"><td>' + value.pac_id + '</td><td>' + value.pac_name + '</td><td>' + value.pac_description + '</td><td>' + value.pac_outlay + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detailPackage('+ value.pac_id +')">Editar productos</button><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+ value.pac_id +')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('+ value.pac_id +')">Elminar</button></div></td></tr>');
            });
        }else{
            $("#paquetes").append('<tr class="gradeX"><td colspan="5">No existen Paquetes registrados en la base de datos</td>');
        }
    }
});
}

function modalUpdate(id){  
    this.id = id;
    read(id);                   
}

function detailPackage(id){
    window.location.href = detailPackageRoute+'/'+id;
}

$(document).ready(function(){
    loadTable();
});