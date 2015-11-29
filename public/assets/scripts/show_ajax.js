var id = '';

function create() {
    var data = {
        "sho_name": $('#sho_name').val(),
        "sho_description": $('#sho_description').val(),
        "sho_media": $('#sho_media').val()
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: createRoute,
        data: data,
        type: 'post',
        success: function(data) {
            if (data.success) {
                alert(data.data);
                loadTable();
                $('#add').modal('hide');
                $(':input', '#agregar').not(':button, :submit, :reset, :hidden').val('');
                $('#sho_media').val('null');
            } else {
                failure(data.data);
            }
        }
    });
}

function read(id) {
    var data = {
        "id": id,
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: readRoute,
        data: data,
        type: 'post',
        success: function(data) {
            if (data.success) {
                $('#u_sho_name').val(data.data['sho_name']);
                $('#u_sho_description').val(data.data['sho_description']);
                $('#u_sho_media').val(data.data['sho_media']);
                $('#updateModal').modal('show');
            } else {
                failure(data.data);
            }
        }
    });
}

function update() {
    var data = {
        "id": this.id,
        "sho_name": $('#u_sho_name').val(),
        "sho_description": $('#u_sho_description').val(),
        "sho_media": $('#u_sho_media').val()
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: updateRoute,
        data: data,
        type: 'post',
        success: function(data) {
            if (data.success) {
                alert(data.data);
                loadTable();
                $('#updateModal').modal('hide');
                $(':input', '#actualizar').not(':button, :submit, :reset, :hidden').val('');
                $('#u_sho_media').val('null');
            } else {
                failure(data.data);
            }
        }
    });
}

function delet(id) {
    var data = {
        "id": id,
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: deleteRoute,
        data: data,
        type: 'post',
        success: function(data) {
            if (data.success) {
                alert(data.data);
                loadTable();
            } else {
                failure(data.data);
            }
        }
    });
}

function loadTable() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: readAllRoute,
        type: 'post',
        success: function(data) {
            if (data.success) {
                $("#unidades_negocio").html('');
                if (data.data !== null && $.isArray(data.data) && data.data.length > 0) {
                    $.each(data.data, function(index, value) {
                        $("#unidades_negocio").append('<tr class="gradeX"><td>' + value.sho_id + '</td><td>' + value.sho_name + '</td><td>' + value.sho_description + '</td><td>' + value.sho_media + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate(' + value.sho_id + ')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet(' + value.sho_id + ')">Elminar</button></div></td></tr>');
                    });
                } else {
                    $("#unidades_negocio").append('<tr class="gradeX"><td colspan="5">No existen Programas registradas en la base de datos</td>');
                }
            } else {
                failure(data.data);
            }
        }
    });
}

function modalUpdate(id) {
    this.id = id;
    read(id);
}
$(document).ready(function() {
    loadTable();
});