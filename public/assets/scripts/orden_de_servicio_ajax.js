var selectedTr = null;
var productCounter = 0;
var productArray = [];
var total = 0;
var impacts_total = 0;
var payments = 0;

function loadTable(){
    selectedTr = null;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   showCustomersRoute,
        type:  'post',
        success:  function (msg) {
            $("#clientes").html('');
            if (msg !== null && $.isArray(msg) && msg.length>0){
                $.each(msg, function(index, value){
                    $("#clientes").append('<tr class="gradeX"><td>'+value.cus_id+'</td><td>'+value.cus_commercial_name+'</td><td>'+value.cus_contact_first_name+' '+value.cus_contact_last_names+'</td><td>'+value.cus_address+'</td><td>'+value.cus_phone_number+'</td><td>'+value.cus_cellphone_number+'</td><td>'+value.cus_email+'</td><td>'+value.tax_business_name+'</td><td>'+value.tax_rfc+'</td></tr>');
                });
                tableSelect();
            }else{
                $("#clientes").append('<tr class="gradeX"><td colspan="9">No existen clientes registrados en la base de datos</td>');
            }
        }
    });
}

function tableSelect(){
    var tr = document.getElementsByTagName('tr');
    for (var i=1;i<tr.length;i++){
        tr[i].addEventListener('click',function(){
            if(selectedTr !== null){
                selectedTr.removeAttr('style');
            }
            selectedTr = $(this); 
            selectedTr.css('background-color', 'orange');
        });
    }
}

function addProduct(){
    switch($('#productSelector').val()){
        case 'spots':
        if($('#radioSpots').is(':checked')){
            var product = {
                pro_type: 'spot',
                pro_amount: $('#amount').val(),
                pro_filomedios_production: '1',
                pro_recording: $('#grabacion_date').val(),
                pro_proposal_1: $('#propuesta_1_date').val(),
                pro_proposal_2: $('#propuesta_2_date').val(),
                pro_customer_delivery: '',
                pro_format: '',
                sho_show: '',
                pro_moth_impacts: $('#month3').text(),
                pro_daily_impacts: $('#day3').text(),
                pro_hour_impacts: $('#hour3').val(),
                pro_description: $('#descripcion_spot').val(),
                
            }
            impacts_total += parseInt($('#month3').text());                    
            productArray[productCounter] = product;
            productCounter++;                   
        }else{
            var product = {
                pro_type: 'spot',
                pro_amount: $('#amount').val(),
                pro_filomedios_production: '0',
                pro_recording: '',
                pro_proposal_1: '',
                pro_proposal_2: '',
                pro_customer_delivery: $('#entrega_date').val(),
                pro_format: $('#format').val(),
                sho_show: '',
                pro_moth_impacts: $('#month3').text(),
                pro_daily_impacts: $('#day3').text(),
                pro_hour_impacts: $('#hour3').val(),
                pro_description: $('#descripcion_spot').val(),
            }
            impacts_total += parseInt($('#month3').text());
            productArray[productCounter] = product;
            productCounter++; 
        }
        break;

        case 'cintillos':
        var product = {
            pro_type: 'cintillo',
            pro_amount: $('#amount').val(),
            pro_filomedios_production: '',
            pro_recording: '',
            pro_proposal_1: '',
            pro_proposal_2: '',
            pro_customer_delivery: '',
            pro_format: '',
            sho_show: '',
            pro_moth_impacts: $('#month').text(),
            pro_daily_impacts: $('#day').text(),
            pro_hour_impacts: $('#hour').val(),
            pro_description: $('#descripcion_cintillo').val(),                
        }        
        impacts_total += parseInt($('#month').text());            
        productArray[productCounter] = product;
        productCounter++;  
        break;

        case 'programas':
        var product = {
            pro_type: 'programa',
            pro_amount: $('#amount').val(),
            pro_filomedios_production: '',
            pro_recording: '',
            pro_proposal_1: '',
            pro_proposal_2: '',
            pro_customer_delivery: '',
            pro_format: '',
            sho_show: $('#program').val(),
            pro_moth_impacts: $('#month2').text(),
            pro_daily_impacts: $('#day2').text(),
            pro_hour_impacts: $('#hour2').val(),
            pro_description: $('#descripcion_programas').val(),                
        } 
        impacts_total += parseInt($('#month2').text());                   
        productArray[productCounter] = product;
        productCounter++;  
        break;

        case 'portalNoticias':
        var product = {
            pro_type: 'portal de noticias',
            pro_amount: $('#amount').val(),
            pro_filomedios_production: '',
            pro_recording: '',
            pro_proposal_1: '',
            pro_proposal_2: '',
            pro_customer_delivery: '',
            pro_format: '',
            sho_show: '',
            pro_moth_impacts: '',
            pro_daily_impacts: '',
            pro_hour_impacts: '',
            pro_description: $('#descripcion_noticias').val(),                
        }                    
        productArray[productCounter] = product;
        productCounter++;  
        break;
    }
    $('#addProduct').modal('hide');
    $('#descripcion_noticias').val('');
    $('#amount').val('');
    $('#program').val('');
    $('#month2').text('');
    $('#day2').text('');
    $('#hour2').val('');
    $('#descripcion_programas').val('');
    $('#month').text('');
    $('#day').text('');
    $('#hour').val('');
    $('#descripcion_cintillo').val('');
    $('#entrega_date').val('');
    $('#format').val('');
    $('#month3').text('');
    $('#day3').text('');
    $('#hour3').val('');
    $('#descripcion_spot').val('');
    $('#grabacion_date').val('');
    $('#propuesta_1_date').val('');
    $('#propuesta_2_date').val('');
    $('#agregarProducto')[0].reset();
    $('#radioSpots').prop('checked',true);
    $('.product').hide();
    $("div.desc").hide();
    $("#option2").show();
}

function buttonCreateProduct(){
    if($('#productSelector').val() == null){
        alert('Debe seleccionar un producto');
    }else{
        addProduct();
        total += parseFloat(productArray[productCounter-1].pro_amount);
        $('#ser_total').val(total);
        $('#ser_contract_impacts').val(impacts_total);
        $("#products").append('<tr class="gradeX"><td>'+productArray[productCounter-1].pro_type+'</td><td>'+productArray[productCounter-1].pro_description+'</td><td>'+productArray[productCounter-1].pro_amount+'</td></tr>');
    }
}

function setAmounts(){
    for (var i = 0; i < (payments*2); i+=2) {
        $('#payment-'+(i+1)).val(total/payments);        
    };
}

function serviceOrderCreate(){

    var paymentArray = [];
    for (var i = 0; i < (payments*2); i+=2) {
        var payment = {
            pay_amount : $('#payment-'+(i+1)).val(),
            pay_estimated_date : $('#payment-'+(i+2)).val()
        }
        paymentArray[i] = payment;        
    };

    var values = {
        "ser_account_payment" : $('#ser_account_payment').val(),
        "ser_total" : $('#ser_total').val(),
        "ser_contract_impacts" : $('#ser_contract_impacts').val(),
        "ser_contract_duration" : $('#months_contract').val(),
        "ser_projection_estimated_start" : $('#start_date_contract').val(),
        "ser_projection_estimated_end" : $('#end_date_contract').val(),
        "ser_fk_customer" : selectedTr.children().eq(0).html(),
        "product_array" : productArray,
        "payment_array" : paymentArray


    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        data:   values,
        url:   createCustomerRoute,
        type:  'post',
        success:  function (msg) {
            alert(msg);
            if (msg.indexOf("Cliente registrado") !== - 1){
                $("#tax_colony").html('');
                $("#tax_colony").append('<option value="">--Seleccionar Colonia---</option>');
                $("#tax_colony" ).prop( "disabled", true );
                loadTable();
                $('#addCustomer').modal('hide');
                $(':input', '#agregarCliente')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
            }                                
        }
    });
}

$(document).ready(function(){
    loadTable();  
});