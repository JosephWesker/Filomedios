var id = '';

function create(){
    var data = {
        'pro_name' : $('#pro_name').val(),
        'pro_description' : $('#pro_description').val(),
        'pro_outlay' : $('#pro_outlay').val(),
        'pro_type' : $('#pro_type').val(),
        'spo_impacts' : $('#spo_impacts').val(),
        'spo_duration' : $('#spo_duration').val(),
        'web_validity' : $('#web_validity').val(),
        'web_media' : $('#web_media').val(),
        'sho_duration' : $('#sho_duration').val(),
        'prd_need_dates' : $('#prd_need_dates').is(':checked')
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
        .removeAttr('checked');
        $('#pro_type').val('null');
        $('#web_media').val('null');
        $('.product').hide();
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
        $('#u_pro_description').val(data.data['pro_description']);
        $('#u_pro_outlay').val(data.data['pro_outlay']);
        $('#u_pro_type').val(data.data['pro_type']);
        switch(data.data['pro_type']){
            case 'Spot':
                $('#u_spo_impacts').val(data.data['spot']['spo_impacts']);
                 
                $('#u_spo_duration').val(data.data['spot']['spo_duration']);
            break;
            case 'Web':
                $('#u_web_validity').val(data.data['web']['web_validity']);
                $('#u_web_media').val(data.data['web']['web_media']);
            break;
            case 'Programa':
                $('#u_sho_duration').val(data.data['show']['sho_duration']);
            break;
            case 'Producción':
                $('#u_prd_need_dates').prop('checked',Boolean(data.data['production']['prd_need_dates']));
            break;
        }
        $('.u_product').hide();
        $('#u_' + data.data['pro_type']).show();        
        $('#updateModal').modal('show');   
    }
});
}

function update(){
    var data = {
        "id" : this.id,
        'pro_name' : $('#u_pro_name').val(),
        'pro_description' : $('#u_pro_description').val(),
        'pro_outlay' : $('#u_pro_outlay').val(),
        'pro_type' : $('#u_pro_type').val(),
        'spo_impacts' : $('#u_spo_impacts').val(),
        'spo_duration' : $('#u_spo_duration').val(),
        'web_validity' : $('#u_web_validity').val(),
        'web_media' : $('#u_web_media').val(),
        'sho_duration' : $('#u_sho_duration').val(),
        'prd_need_dates' : $('#u_prd_need_dates').is(':checked')
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
            .removeAttr('checked');
            $('#u_pro_type').val('null');
            $('#u_web_media').val('null');
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
                $("#productos").append('<tr class="gradeX"><td>'+ value.pro_id +'</td><td>'+ value.pro_name +'</td><td>'+ value.pro_description +'</td><td>'+ value.pro_type +'</td><td>'+ value.pro_outlay +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+ value.pro_id +')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('+ value.pro_id +')">Elminar</button></div></td></tr>');
            });
        }else{
            $("#productos").append('<tr class="gradeX"><td colspan="6">No existen Productos registrados en la base de datos</td>');
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