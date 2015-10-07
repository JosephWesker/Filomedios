// spots
$(document).ready(function () {
    $('#productSelector').change(function () {
        $('.product').hide();
        $('#' + $(this).val()).show();
    });
});

$(document).ready(function () {
    $('#durationSelector').change(function () {
        if (this.checked)
            //  ^
            $('.duration').show();
        else
            $('.duration').hide();
    });
});




// cintillos

$(document).ready(function () {
    $('#hour').keyup(function () {
        $('#day').text($(this).val() * 12);
        $('#month').text($(this).val() * 12 * 30);
    });
});

$(document).ready(function () {
    $('#hour2').keyup(function () {
        $('#day2').text($(this).val() * 12);
        $('#month2').text($(this).val() * 12 * 30);
    });
});


$(document).ready(function () {
    $('#hour3').keyup(function () {
        $('#day3').text($(this).val() * 12);
        $('#month3').text($(this).val() * 12 * 30);
    });
});