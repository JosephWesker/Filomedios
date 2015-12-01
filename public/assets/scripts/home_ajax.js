function loadCharts(json) {
    /*var chart = new Highcharts.Chart({
        chart: {            
            renderTo: render
        },
        credits: {
            enabled: false
        },
        title: {
            text: title
        },
        xAxis: {
            categories: [categorie]
        },
        yAxis: {
            title: {
                text: titleY
            }
        },
        tooltip: {
            valueSuffix: suffix
        },
        series: series
    });*/
    var chart = new Highcharts.Chart(json);
}

function getDataForCharts(url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: url,
        type: 'post',
        success: function(data) {
            loadCharts(data.data);
        }
    });
}
$(document).ready(function() {
    getDataForCharts(chartSalesRoute);
    getDataForCharts(chartPaymentsRoute);
    getDataForCharts(chartSalersRoute);
});