$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap"); //Fields wrapper
    var add_button = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input class="form-control" style="width: 80%; display: inline-block; margin-bottom: 10px;" type="date" name="mytext[]"/><a style="margin-left: 10px; color: #c9302c;" href="#" class="remove_field"><i class="fa fa-times-circle" style="float: right; cursor: pointer; font-size: 30px;"></i></a></div>'); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});




$(document).ready(function () {
    var max_fields = 10; //maximum input boxes allowed
    var wrapper = $(".input_fields_wrap_date"); //Fields wrapper
    var add_button = $(".add_field_button_date"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function (e) { //on add input button click
        e.preventDefault();
        if (x < max_fields) { //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="form-group form-group-sm input_fields_wrap_date" style="margin-bottom: 10px!important; display: inline-block; width: 80%;"><label class="col-sm-1 control-label" for="formGroupInputSmall">Inicia</label><div class="col-sm-3"><div class=""><div><input class="form-control" id="input-multi" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]"></div></div></div><label class="col-sm-1 control-label" for="formGroupInputSmall">Termina</label><div class="col-sm-3"><div class=""><div><input class="form-control" id="input-multi" style="margin-bottom: 10px!important; display: inline-block; width: 80%;" type="date" name="mytext[]"></div></div></div><a style="margin-left: 10px; color: #c9302c;" href="#" class="remove_field_date"><i class="fa fa-times-circle" style="float: left; cursor: pointer; font-size: 30px;"></i></a></div>'); //add input box
        }
    });

    $(wrapper).on("click", ".remove_field_date", function (e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});



        