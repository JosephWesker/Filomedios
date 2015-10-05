var id = '';

function create(){
    var data = {
        "pro_name" : $('#pro_name').val(),
        "pro_type" : $('#pro_type').val(),
        "pro_description" : $('#pro_description').val(),
        "pro_has_show" : $('input[name=has_show]:checked').val(),        
        "pro_has_scheme" : $('input[name=has_schema]:checked').val(),
        "pro_has_production_registry" : $('input[name=has_production_registry]:checked').val(),
        "pro_duration_type" : $('#pro_duration_type').val(),
        "pro_duration" : $('#pro_duration').val(),
        "pro_daily_impacts" : $('#pro_daily_impacts').val(),
        "pro_outlay" : $('#pro_outlay').val()
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
        $('#u_pro_name').val(data.data['pro_name']);
        $('#u_pro_type').val(data.data['pro_type']);
        $('#u_pro_description').val(data.data['pro_description']);
        $('input[name="u_has_show"][value="' + data.data['pro_has_show'] + '"]').prop('checked', true);
        $('input[name="u_has_schema"][value="' + data.data['pro_has_schema'] + '"]').prop('checked', true);
        $('input[name="u_has_production_registry"][value="' + data.data['pro_has_production_registry'] + '"]').prop('checked', true); 
        $('#u_pro_duration_type').val(data.data['pro_duration_type']);
        $('#u_pro_duration').val(data.data['pro_duration']);
        $('#u_pro_daily_impacts').val(data.data['pro_daily_impacts']);
        $('#u_pro_outlay').val(data.data['pro_outlay']);
        $('#updateModal').modal('show');   
    }
});
}

function update(){
    var data = {
        "id" : this.id,
        "pro_name" : $('#u_pro_name').val(),
        "pro_type" : $('#u_pro_type').val(),
        "pro_description" : $('#u_pro_description').val(),
        "pro_has_show" : $('input[name=u_has_show]:checked').val(),        
        "pro_has_scheme" : $('input[name=u_has_schema]:checked').val(),
        "pro_has_production_registry" : $('input[name=u_has_production_registry]:checked').val(),
        "pro_duration_type" : $('#u_pro_duration_type').val(),
        "pro_duration" : $('#u_pro_duration').val(),
        "pro_daily_impacts" : $('#u_pro_daily_impacts').val(),
        "pro_outlay" : $('#u_pro_outlay').val()
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
        $("#productos").html('');
        if (data.data !== null && $.isArray(data.data) && data.data.length>0){
            $.each(data.data, function(index, value){
                $("#productos").append('<tr class="gradeX"><td>'+ value.pro_id +'</td><td>'+ value.pro_name +'</td><td>'+ value.pro_type +'</td><td>'+ value.pro_description +'</td><td>'+ value.pro_duration+" "+ value.pro_duration_type +'</td><td>'+ value.pro_daily_impacts +'</td><td>'+ value.pro_outlay +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+ value.pro_id +')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('+ value.pro_id +')">Elminar</button></div></td></tr>');
            });
        }else{
            $("#productos").append('<tr class="gradeX"><td colspan="8">No existen Productos registradas en la base de datos</td>');
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