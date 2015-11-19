var id = null;

function loadPayments(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   readPaymentsRoute,
        type:  'post',
        success:  function (data) {
            $("#factura").html('');
            if (data.invoice !== null && $.isArray(data.invoice) && data.invoice.length>0){
                $.each(data.invoice, function(index, value){
                    $("#factura").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_fk_payment_data +'</td><td>'+ value.payment_scheme.service_order.customer.cus_contact_first_name +' '+ value.payment_scheme.service_order.customer.cus_contact_last_name +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Registrar Factura</button></div></td></tr>');
                });
            }else{
                $("#factura").append('<tr class="gradeX"><td colspan="7">No existen pagos pendientes de factura</td>');
            }
            $("#nota").html('');
            if (data.recipt !== null && $.isArray(data.recipt) && data.recipt.length>0){
                $.each(data.recipt, function(index, value){
                    $("#nota").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_fk_payment_data +'</td><td>'+ value.payment_scheme.service_order.customer.cus_contact_first_name +' '+ value.payment_scheme.service_order.customer.cus_contact_last_name +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Registrar Nota de Venta</button></div></td></tr>');
                });
            }else{
                $("#nota").append('<tr class="gradeX"><td colspan="7">No hay fechas pendientes de cobro vencidas</td>');
            }
        }
    });
}

function detail(id){
    id = id;
    $('#add').modal('show');
}

function sendData(){
    var data = {
        'id': id,
        'content': $('#ind_content').val()
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   saveInvoiceRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert(data.data);
            $('#add').modal('hide');
            loadPayments();
        }
    });
}

$(document).ready(function(){
    loadPayments();
});