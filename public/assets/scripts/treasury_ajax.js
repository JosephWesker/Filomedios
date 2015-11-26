var idToPay = null;

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
            $("#pendientes").html('');
            if (data.outstanding !== null && $.isArray(data.outstanding) && data.outstanding.length>0){
                $.each(data.outstanding, function(index, value){
                    $("#pendientes").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_ser_id +'</td><td><b>Contacto:</b> '+ value.service_order.customer.cus_contact_first_name +' '+ value.service_order.customer.cus_contact_last_name +', <b>Empresa:</b> '+ value.service_order.customer.cus_commercial_name +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Pagar</button></div></td></tr>');
                });
            }else{
                $("#pendientes").append('<tr class="gradeX"><td colspan="7">No hay fechas pendientes de cobro</td>');
            }
            $("#vencidos").html('');
            if (data.late !== null && $.isArray(data.late) && data.late.length>0){
                $.each(data.late, function(index, value){
                    $("#vencidos").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_ser_id +'</td><td><b>Contacto:</b> '+ value.service_order.customer.cus_contact_first_name +' '+ value.service_order.customer.cus_contact_last_name +', <b>Empresa:</b> '+ value.service_order.customer.cus_commercial_name +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Pagar</button></div></td></tr>');
                });
            }else{
                $("#vencidos").append('<tr class="gradeX"><td colspan="7">No hay fechas pendientes de cobro vencidas</td>');
            }
            $("#completados").html('');
            if (data.full !== null && $.isArray(data.full) && data.full.length>0){
                $.each(data.full, function(index, value){
                    $("#completados").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_ser_id +'</td><td><b>Contacto:</b> '+ value.service_order.customer.cus_contact_first_name +' '+ value.service_order.customer.cus_contact_last_name +', <b>Empresa:</b> '+ value.service_order.customer.cus_commercial_name +'</td></tr>');
                });
            }else{
                $("#completados").append('<tr class="gradeX"><td colspan="7">No hay fechas cobradas</td>');
            }
        }
    });
}

function loadServiceOrders(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   readServiceOrderRoute,
        type:  'post',
        success:  function (data) {
            $("#vigentes").html('');
            if (data.activeServiceOrder !== null && $.isArray(data.activeServiceOrder) && data.activeServiceOrder.length>0){
                $.each(data.activeServiceOrder, function(index, value){
                    $("#vigentes").append('<tr class="gradeX"><td>'+ value.ser_id +'</td><td><b>Contacto:</b> '+ value.customer.cus_contact_first_name +' '+ value.customer.cus_contact_last_name +', <b>Empresa:</b> '+ value.customer.cus_commercial_name +'</td><td>'+ value.ser_start_date +'</td><td>'+ value.ser_end_date +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="viewPayments(\''+value.ser_id+'\')">Ver Detalles</button></div></td></tr>');
                });
            }else{
                $("#vigentes").append('<tr class="gradeX"><td colspan="7">No existen ordenes de servicio vigentes</td>');
            }
            $("#anteriores").html('');
            if (data.historyServiceOrder !== null && $.isArray(data.historyServiceOrder) && data.historyServiceOrder.length>0){
                $.each(data.historyServiceOrder, function(index, value){
                    $("#anteriores").append('<tr class="gradeX"><td>'+ value.ser_id +'</td><td><b>Contacto:</b> '+ value.customer.cus_contact_first_name +' '+ value.customer.cus_contact_last_name +', <b>Empresa:</b> '+ value.customer.cus_commercial_name +'</td><td>'+ value.ser_start_date +'</td><td>'+ value.ser_end_date +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="viewPayments(\''+value.ser_id+'\')">Ver Detalles</button></div></td></tr>');
                });
            }else{
                $("#anteriores").append('<tr class="gradeX"><td colspan="7">No hay ordenes de servicio anteriores</td>');
            }
        }
    });
}

function viewPayments(id){
    window.location.href = paymentsServiceOrderRoute+'/'+id;
}

function detail(id){
    idToPay = id;
    $('#add').modal('show');
}

function checkForAccount(){
    $("#rpa_account").val('');
    if($("#rpa_method").val()!='contado'){      
        $("#account").show();
    }else{
        $("#account").hide();
    }
}

function sendPayment(){
    var data = {
        'rpa_fk_payment_date' : idToPay,
        'rpa_method' : $("#rpa_method").val(),
        'rpa_account' : $("#rpa_account").val()
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   sendPaymentRoute,
        type:  'post',
        data: data,
        success:  function (data) {
            alert(data.data);
            $('#add').modal('hide');
            loadPayments();
        }
    });
}

$(document).ready(function(){
    loadPayments();
    loadServiceOrders();
});