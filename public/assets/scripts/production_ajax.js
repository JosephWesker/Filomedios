var calendar = null;
var selectedTr = null;

function loadServiceOrders(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   getServiceOrdersRoute,
        type:  'post',
        success:  function (data) {
            $("#serviceOrders").html('');
            if (data.data !== null && $.isArray(data.data) && data.data.length>0){
                $.each(data.data, function(index, value){
                    $("#serviceOrders").append('<tr class="gradeX"><td>'+ value.id +'</td><td>'+ value.customer +'</td><td>'+ value.start_date +'</td></tr>');
                });
                tableSelect();
            }else{
                $("#serviceOrders").append('<tr class="gradeX"><td colspan="7">No existen ordenes de servicio vigentes</td>');
            }
        }
    });
}

function tableSelect(){
    var table = document.getElementById("serviceOrders");
    var tr = table.getElementsByTagName('tr');
    for (var i=0;i<tr.length;i++){
        tr[i].addEventListener('click',function(){
            if(selectedTr !== null){
                selectedTr.removeAttr('style');
                if (selectedTr[0].innerHTML != $(this)[0].innerHTML) {
                    selectedTr = $(this); 
                    selectedTr.css('background-color', 'orange');
                    getDatesByServiceOrder();   
                }else{
                    selectedTr = null;
                    loadCalendar(getDatesRoute);
                };
            }else{
                selectedTr = $(this); 
                selectedTr.css('background-color', 'orange');
                getDatesByServiceOrder();  
            }
        });
    }
}

function getDatesByServiceOrder(){
    var data = {
        'id' : selectedTr.children().eq(0).html(),
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   getDatesByServiceOrderRoute,
        data: data,
        type:  'post',
        success:  function (data) {            
            loadCalendar(data.result);
        }
    });
}

function loadCalendar(values){
    "use strict";

    var options = {
        events_source: values,
        view: 'month',
        tmpl_path: 'assets/scripts/bootstrap-calendar/tmpls/',
        tmpl_cache: false,
        day: 'now',
        language: 'es-MX',
        modal: "#events-modal",
        modal_type: "ajax",
        modal_title: function (e) {
            return e.title;
        },
        format12: true,
        am_suffix: "AM",
        pm_suffix: "PM",
        time_start: '09:00',
        time_end: '22:00',
        time_split: '30',
        onAfterEventsLoad: function (events) {
            if (!events) {
                return;
            }
            var list = $('#eventlist');
            list.html('');

            $.each(events, function (key, val) {
                $(document.createElement('li'))
                .html('<a href="' + val.url + '">' + val.title + '</a>')
                .appendTo(list);
            });
        },
        onAfterViewLoad: function (view) {
            $('.page-header h3').text(this.getTitle());
            $('.btn-group button').removeClass('active');
            $('button[data-calendar-view="' + view + '"]').addClass('active');
        },
        classes: {
            months: {
                general: 'label'
            }
        }

    };

    calendar = $('#calendar').calendar(options);

    $('.btn-group button[data-calendar-nav]').each(function () {
        var $this = $(this);
        $this.click(function () {
            calendar.navigate($this.data('calendar-nav'));
        });
    });

    $('.btn-group button[data-calendar-view]').each(function () {
        var $this = $(this);
        $this.click(function () {
            calendar.view($this.data('calendar-view'));
        });
    });

    $('#first_day').change(function () {
        var value = $(this).val();
        value = value.length ? parseInt(value) : null;
        calendar.setOptions({first_day: value});
        calendar.view();
    });

    $('#language').change(function () {
        calendar.setLanguage($(this).val());
        calendar.view();
    });

    $('#events-in-modal').change(function () {
        var val = $(this).is(':checked') ? $(this).val() : null;
        calendar.setOptions({modal: val});
    });
    $('#format-12-hours').change(function () {
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({format12: val});
        calendar.view();
    });
    $('#show_wbn').change(function () {
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({display_week_numbers: val});
        calendar.view();
    });
    $('#show_wb').change(function () {
        var val = $(this).is(':checked') ? true : false;
        calendar.setOptions({weekbox: val});
        calendar.view();
    });
    $('#events-modal .modal-footer').click(function (e) {

    });
}


$(document).ready(function(){
    loadServiceOrders();
    loadCalendar(getDatesRoute);
});