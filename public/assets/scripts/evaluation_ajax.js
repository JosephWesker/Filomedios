function saveGoals(){
    var data = {
        'res_customer_porcent' : $('#res_customer_porcent').val(),
        'res_duration_average' : $('#res_duration_average').val(),
        'res_sales_volume' : $('#res_sales_volume').val()
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: createGoalsRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert(data.data);
            $('#res_customer_porcent').val('');
            $('#res_duration_average').val('');
            $('#res_sales_volume').val('');
            $('#add').modal('hide');
            readGoals();
        }
    });
}

function readGoals(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: readGoalsRoute,
        type:  'post',
        success:  function (data) {
            $("#evaluations").html('');
            if (data.data !== null && $.isArray(data.data) && data.data.length>0){
                $.each(data.data, function(index, value){
                    if (value.goa_status == 1) {
                        $("#evaluations").append('<tr class="gradeX"><td>'+ value.goa_id +'</td><td>'+ value.goa_customer_porcent +'</td><td>'+ value.goa_duration_average +'</td><td>'+ value.goa_sales_volume +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-success btn-sm" type="button" onclick="activateGoal('+ value.goa_id +')" disabled>Activar</button></div></td></tr>');
                    }else{
                        $("#evaluations").append('<tr class="gradeX"><td>'+ value.goa_id +'</td><td>'+ value.goa_customer_porcent +'</td><td>'+ value.goa_duration_average +'</td><td>'+ value.goa_sales_volume +'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="activateGoal('+ value.goa_id +')">Activar</button></div></td></tr>');
                    }
                });
            }else{
                $("#evaluations").append('<tr class="gradeX"><td colspan="6">No hay metas registradas en la base de datos</td>');
            }
        }
    });
}

function activateGoal(id){
    var data = {
        'id' : id,
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: activateRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert(data.data);
            readGoals(); 
        }
    });
}

function updateEvaluations(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: updateEvaluationsRoute,
        type:  'post',
        success:  function (data) {
            alert(data.data); 
        }
    });
}

$(document).ready(function(){
    readGoals();
});