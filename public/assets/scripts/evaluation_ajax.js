var dataForProyection = null;
var goaCustomerPorcent = 0;
var goaDurationAverage = 0;
var goaSalesVolume = 0;

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
            setEmployees();
            getProyections();
            $('.charts').hide();
            resetTable();
            $('#eva_tim_id').html('');
            $('#eva_tim_id')
            .append($("<option></option>")
               .attr("value",'null')
               .text('---Seleccionar Mes/Año---'));
            $('#eva_tim_id').prop('disabled',true); 
        }
    });
}

function setEmployees(){
    $('#eva_emp_id').html('');
    $('#eva_emp_id')
    .append($("<option></option>")
       .attr("value",'null')
       .text('---Seleccionar Empleado---'));

    $('#searchButton').prop('disabled',true);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: getEmployeesRoute,
        type:  'post',
        success:  function (data) {
            $.each(data.data, function(index, value) {   
                $('#eva_emp_id')
                .append($("<option></option>")
                   .attr("value",value.id)
                   .text(value.name));
            }); 
        }
    });
}

function getDates(){
    $('.charts').hide();
    resetTable();
    $('#eva_tim_id').html('');
    $('#eva_tim_id')
    .append($("<option></option>")
       .attr("value",'null')
       .text('---Seleccionar Mes/Año---'));

    $('#searchButton').prop('disabled',true);   

    if ($('#eva_emp_id').val() != 'null') {
        var data = {
            'id' : $('#eva_emp_id').val(),
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: getDatesRoute,
            data: data,
            type:  'post',
            success:  function (data) {
                $.each(data.data, function(index, value) {   
                    $('#eva_tim_id')
                    .append($("<option></option>")
                       .attr("value",value.id)
                       .text(value.value));
                }); 
                $('#eva_tim_id').prop('disabled',false);

            }
        });
    }else{
        $('#eva_tim_id').prop('disabled',true);
    };
}

function enableSearch(){
    $('.charts').hide();
    resetTable();
    if ( $('#eva_tim_id').val()!='null') {
        $('#searchButton').prop('disabled',false);
    }else{
        $('#searchButton').prop('disabled',true);
    };
}

function getEvaluation(){
    var data = {
        'eva_id' : $('#eva_tim_id').val(),
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: getEvaluationRoute,
        data: data,
        type:  'post',
        success:  function (data) {
           $("#goalsResult").html('');
           $("#resultsTab").html('');
           $("#goalsResult").append('<tr class="gradeX"><td>'+ data.data.goals.goa_customer_porcent +'</td><td>'+ data.data.goals.goa_duration_average +'</td><td>'+ data.data.goals.goa_sales_volume +'</td></tr>');
           $("#resultsTab").append('<tr class="gradeX"><td>'+ data.data.result.res_customer_porcent +'</td><td>'+ data.data.result.res_duration_average +'</td><td>'+ data.data.result.res_sales_volume +'</td><td>'+ data.data.time.tim_month +'</td><td>'+ data.data.time.tim_year +'</td><td>'+ data.data.eva_achieved_goals +'</td></tr>');
           var name = data.data.employee.emp_first_name +' '+ data.data.employee.emp_last_name;
           var date = data.data.time.tim_month +'/'+ data.data.time.tim_year;
           $('.charts').show();
           loadCharts(name,data.data.goals.goa_customer_porcent,data.data.result.res_customer_porcent,'% de Clientes','charts1','Porcentaje',date,' %');
           loadCharts(name,parseFloat(data.data.goals.goa_duration_average),parseFloat(data.data.result.res_duration_average),'Duración Promedio del Contrato','charts2','Meses',date,' Meses');
           loadCharts(name,parseFloat(data.data.goals.goa_sales_volume),parseFloat(data.data.result.res_sales_volume),'Volumen de Ventas','charts3','Pesos',date,' Pesos');
       }
   });
}

function getProyections(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: getProyectionsRoute,
        type:  'post',
        success:  function (data) {
           dataForProyection = data.data;
           setProyectionTable();
       }
   });
}

function setProyectionTable(){
    $('#proyections').html('');
    $.each(dataForProyection, function(index,value){
        var result = 0;
        if (value.res_customer_porcent >= goaCustomerPorcent) {
            result = result + 1;
        };
        if (value.res_duration_average >= goaDurationAverage) {
            result = result + 1;
        };
        if (value.res_sales_volume >= goaSalesVolume) {
            result = result + 1;
        };
        $('#proyections').append('<tr class="gradeX"><td>'+ value.name +'</td><td>'+ value.res_customer_porcent +'</td><td>'+ value.res_duration_average +'</td><td>'+ value.res_sales_volume +'</td><td>'+ result +'</td></tr>');
    });
}

function calculateGoaCustomerPorcent(){
    goaCustomerPorcent = parseFloat($('#t_res_customer_porcent').val());
    if($('#t_res_customer_porcent').val() == ''){
        goaCustomerPorcent = 0;
    }
    setProyectionTable();
     prepareProyectionCharts();
}

function calculateGoaDurationAverage(){
    goaDurationAverage = parseFloat($('#t_res_duration_average').val());
    if($('#t_res_duration_average').val() == ''){
        goaDurationAverage = 0;
    }
    setProyectionTable();
     prepareProyectionCharts();
}

function calculateGoaSalesVolume(){
    goaSalesVolume = parseFloat($('#t_res_sales_volume').val());
    if($('#t_res_sales_volume').val() == ''){
        goaSalesVolume = 0;
    }
    setProyectionTable(); 
    prepareProyectionCharts();
}

function loadCharts(employee,goal,result,categorie,render,title,date,suffix){
    var chart = new Highcharts.Chart({
        chart: {
            type: 'bar',
            renderTo: render
        },
        credits: {
            enabled: false
        },
        title: {
            text: categorie
        },
        xAxis: {
            categories: [date]
        },
        yAxis: {
            title: {
                text: title
            }
        },
        tooltip: {
            valueSuffix: suffix
        },
        series: [{
            name: 'Meta',
            data: [goal]
        }, {
            name: employee,
            data: [result]
        }]
    });
}

function prepareProyectionCharts(){
    var array = [];
    array[array.length] = {
        'name' : 'Metas',
        'data': [goaCustomerPorcent]
    }
    $.each(dataForProyection, function(index, value) {   
        array[array.length] = {
            'name' : value.name,
            'data': [value.res_customer_porcent]
        }
    });
    loadProyectionCharts('ProyectionCharts1','% de Clientes','Porcentaje',array,' %');
    var array2 = [];
    array2[array2.length] = {
        'name' : 'Metas',
        'data': [goaDurationAverage]
    }
    $.each(dataForProyection, function(index, value) {   
        array2[array2.length] = {
            'name' : value.name,
            'data': [value.res_duration_average]
        }
    });
    loadProyectionCharts('ProyectionCharts2','Duración Promedio del Contrato','Meses',array2,' Meses');
    var array3 = [];
    array3[array3.length] = {
        'name' : 'Metas',
        'data': [goaSalesVolume]
    }
    $.each(dataForProyection, function(index, value) {   
        array3[array3.length] = {
            'name' : value.name,
            'data': [value.res_sales_volume]
        }
    }); 
    loadProyectionCharts('ProyectionCharts3','Volumen de Ventas','Pesos',array3,' Pesos');
}

function loadProyectionCharts(render,title,datatype,series,suffix){
    var chart = new Highcharts.Chart({
        chart: {
            type: 'bar',
            renderTo: render
        },
        credits: {
            enabled: false
        },
        title: {
            text: title
        },
        tooltip: {
            valueSuffix: suffix
        },
        yAxis: {
            title: {
                text: datatype
            }
        },
        series: series
    });
}

function resetTable(){
 $("#goalsResult").html('');
 $("#resultsTab").html('');
 $("#goalsResult").append('<tr class="gradeX"><td colspan="3">Selecciona Empleado y Fecha para ver resultados</td></tr>');
 $("#resultsTab").append('<tr class="gradeX"><td colspan="3">Selecciona Empleado y Fecha para ver resultados</td></tr>'); 
}

$(document).ready(function(){
    readGoals();
    setEmployees();
    getProyections();
    setTabListener();   
});