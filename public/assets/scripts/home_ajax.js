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
$(document).ready(function() {
    readGoals();
    setEmployees();
    getProyections();
    setTabListener();
});