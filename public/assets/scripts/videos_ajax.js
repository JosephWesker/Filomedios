function setallselect(select) {
    if (select.is(':checked')) {
        $("."+select.attr('id')).prop('checked', true);
    } else {
        $("."+select.attr('id')).prop('checked', false);
    }
}

function setDisabledAll(classToChange) {
    var values = $("."+classToChange);
    result = true;
    $.each(values, function(index, value) {
        if (!value.checked) {
            result = false;
        }
    });
    $('#'+classToChange).prop('checked', result);
}

function setServiceOrderDisabled(){
    $('#vid_service_order').val('null');
    $('#vid_service_order').prop('disabled',!($('#vid_service_order').prop('disabled')));
}

function getDimension(classToEvaluate){
    var array = {};
    var checks = $('.'+classToEvaluate);
    $.each(checks, function(index, value){
        array[value.id] = value.checked;
    });
    return array;
}

function sendFile(){
    var data = {
        'vid_name' : $('#vid_name').val(),
        'vid_type' : $('#vid_type').val(),
        'vid_service_order' : $('#vid_service_order').val(),
        'vid_type_impacts' : $('#vid_type_impacts').val(),
        'vid_impacts' : $('#vid_impacts').val(),
        'vid_start_date' : $('#vid_start_date').val(),
        'vid_end_date' : $('#vid_end_date').val(),
        'vid_fk_days' : getDimension('day_all'),
        'vid_fk_schedule' : getDimension('sch_all'),
        'file' : ($('#file').prop('files'))[0]
    };
    
}

$(document).ready(function() {

});