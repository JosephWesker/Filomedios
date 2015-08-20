
            $(document).ready(function() {
                var max_fields = 10; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap"); //Fields wrapper
                var add_button = $(".add_field_button"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function(e) { //on add input button click
                    e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div><input class="form-control" style="width: 80%; display: inline-block; margin-bottom: 10px;" type="date" name="mytext[]"/><a style="margin-left: 10px; color: #c9302c;" href="#" class="remove_field"><i class="fa fa-times-circle" style="float: right; cursor: pointer; font-size: 30px;"></i></a></div>'); //add input box
                    }
                });

                $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            });
            $(document).ready(function() {
                var max_fields = 10; //maximum input boxes allowed
                var wrapper = $(".input_fields_wrap-2"); //Fields wrapper
                var add_button = $(".add_field_button-2"); //Add button ID

                var x = 1; //initlal text box count
                $(add_button).click(function(e) { //on add input button click
                    e.preventDefault();
                    if (x < max_fields) { //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div><input class="form-control" style="width: 80%; display: inline-block; margin-bottom: 10px;" type="text" name="mytext[]"/><a style="margin-left: 10px; color: #c9302c;" href="#" class="remove_field-2"><i class="fa fa-times-circle" style="float: right; cursor: pointer; font-size: 30px;"></i></a></div>'); //add input box
                    }
                });

                $(wrapper).on("click", ".remove_field-2", function(e) { //user click on remove text
                    e.preventDefault();
                    $(this).parent('div').remove();
                    x--;
                })
            });



        