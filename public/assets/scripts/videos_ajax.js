function disableDetail() {
    if ($('#vid_service_order').val() == 'null') {
        $('#vid_detail_product').prop('disabled', true);
    } else {
        $('#vid_detail_product').prop('disabled', false);
    }
}

function sendFile() {
    var data = {
        'vid_name': $('#vid_name').val(),
        'vid_detail_product': $('#vid_detail_product').val(),
        'file': ($('#file').prop('files'))[0]
    };

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
    data = {
        'ser_id': $('#vid_service_order').val()
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: serviceOrdersRoute,
        data: data,
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

$(document).ready(function () {
    loadServiceOrders();
});