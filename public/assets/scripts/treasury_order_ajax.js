function loadPayments(){
    $("#pendientes").html('');
    if (outstanding !== null && $.isArray(outstanding) && outstanding.length>0){
        $.each(outstanding, function(index, value){
            $("#pendientes").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_outstanding +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_fk_payment_data +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Ver Detalles</button></div></td></tr>');
        });
    }else{
        $("#pendientes").append('<tr class="gradeX"><td colspan="7">No hay fechas pendientes de cobro</td>');
    }
    $("#completados").html('');
    if (full !== null && $.isArray(full) && full.length>0){
        $.each(full, function(index, value){
            $("#completados").append('<tr class="gradeX"><td>'+ value.pda_amount +'</td><td>'+ value.pda_date +'</td><td>'+ value.pda_fk_payment_data +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="detail('+value.pda_id+')">Ver Detalles</button></div></td></tr>');
        });
    }else{
        $("#completados").append('<tr class="gradeX"><td colspan="7">No hay fechas cobradas</td>');
    }
}

function detail(id){
    window.location.href = paymentsServiceOrderRoute+'/pago/'+id;
}


$(document).ready(function(){
    loadPayments();
});