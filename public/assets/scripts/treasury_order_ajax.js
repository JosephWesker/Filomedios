function loadPayments(){
    $("#pendientes").html('');
    if (outstanding !== null && $.isArray(outstanding) && outstanding.length>0){
        $.each(outstanding, function(index, value){
            $("#pendientes").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_ser_id +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Pagar</button></div></td></tr>');
        });
    }else{
        $("#pendientes").append('<tr class="gradeX"><td colspan="7">No hay fechas pendientes de cobro</td>');
    }
    $("#vencidos").html('');
    if (late !== null && $.isArray(late) && late.length>0){
        $.each(late, function(index, value){
            $("#vencidos").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_ser_id +'</td><td>'+ value.payment_scheme.service_order.customer.cus_contact_first_name +' '+ value.payment_scheme.service_order.customer.cus_contact_last_name +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Pagar</button></div></td></tr>');
        });
    }else{
        $("#vencidos").append('<tr class="gradeX"><td colspan="7">No hay fechas pendientes de cobro vencidas</td>');
    }
    $("#completados").html('');
    if (full !== null && $.isArray(full) && full.length>0){
        $.each(full, function(index, value){
            $("#completados").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_ser_id +'</td></tr>');
        });
    }else{
        $("#completados").append('<tr class="gradeX"><td colspan="7">No hay fechas cobradas</td>');
    }
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
            location.reload();
        }
    });
}


$(document).ready(function(){
    loadPayments();
});