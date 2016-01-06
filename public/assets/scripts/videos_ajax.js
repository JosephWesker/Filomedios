function disableDetail() {
    if ($('#vid_service_order').val() == 'null') {
        $('#vid_detail_product').prop('disabled', true);
        $('#vid_type').prop('disabled', true);
    } else {
        $('#vid_detail_product').prop('disabled', false);
        $('#vid_type').prop('disabled', false);
        loadDetails();
    }
}

function sendFile() {
    /*var data = {
        'vid_name': $('#vid_name').val(),
        'det_id': $('#vid_detail_product').val(),
        'vid_type': $('#vid_type').val(),
        'file': ($('#file').prop('files'))[0]
    };*/
    var data = new FormData();
    data.append('vid_name', $('#vid_name').val());
    data.append('det_id', $('#vid_detail_product').val());
    data.append('vid_type', $('#vid_type').val());
    data.append('file', ($('#file').prop('files'))[0]);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: sendFileRoute,
        data: data,
        type: 'post',
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (data) {
            if (data.success) {
                alert(data.data);
                $('#vid_name').val('');
                $('#vid_service_order').val('null');
                $('#vid_type').val('program');
                $('#file').val('');
                $('#vid_detail_product').html('');
                $('#add').modal('hide');
                disableDetail(); 
            } else {
                failure(data.data);
            }
        }
    });

}

function loadServiceOrders() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: serviceOrdersRoute,
        type: 'post',
        success: function (data) {
            if (data.success) {
                $.each(data.data, function (index, value) {
                    $('#vid_service_order').append('<option value=\'' + value.ser_id + '\'>' + value.ser_id + '</option>');
                });
            } else {
                failure(data.data);
            }

        }
    });
}

function loadDetails() {
    var data = {
        'ser_id': $('#vid_service_order').val(),
        'vid_type': $('#vid_type').val()
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: detailsRoute,
        data: data,
        type: 'post',
        success: function (data) {
            if (data.success) {
                $('#vid_detail_product').html('');
                $.each(data.data, function (index, value) {
                    $('#vid_detail_product').append('<option value=\'' + value.det_id + '\'>' + value.product.pro_name + '</option>');
                });
            } else {
                failure(data.data);
            }
        }
    });
}

$(document).ready(function () {
    loadServiceOrders();
});