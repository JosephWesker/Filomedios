var monthOutlay = 0;
var totalOutlay = 0;
var payments = 0;
var hasIVA = false;
var iva = 0;
var ser_discount = 0;
var amountKind = 0;
var monthsContract = 0;

function loadPostalCodes(){
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

 $.ajax({
    url:   readPostalCodesRoute,
    type:  'post',
    success:  function (data) {
        if (data.data !== null && $.isArray(data.data) && data.data.length>0){
            $.each(data.data, function(index, value){
                $("#tax_postal_code").append('<option value="'+value.pos_postal_code+'">'+value.pos_postal_code+'</option>');
            });
        }else{
            $("#tax_postal_code").prop('disabled','disabled');
        }
        setCustomer(json.customer);
    }
});
}

$( "#tax_postal_code" ).change(function() {
    var tax_postal_code = $('#tax_postal_code').val();
    if(tax_postal_code != "null"){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
        data: {'id' : tax_postal_code },
        url:   readAddressData,
        type:  'post',
        success:  function (data) {
            $("#tax_colony").html('');
            var array = data.data['pos_colony'].split(";");
            $.each(array, function(index, value){
                $("#tax_colony").append('<option value="'+value+'">'+value+'</option>');
            });
            $( "#tax_colony" ).prop( "disabled", false );
            $('#tax_town').val(data.data['pos_town']);
            $('#tax_state').val(data.data['pos_state']);
            $('#tax_country').val(data.data['pos_country']);  
        }
    });
  }else{
    $("#tax_colony").html('');
    $("#tax_colony").append('<option value="">--Seleccionar Colonia---</option>');
    $("#tax_colony" ).prop( "disabled", true );
    $('#tax_town').val('');
    $('#tax_state').val('');
    $('#tax_country').val('');  
}
});

function setCustomer(data){
    var array = AddressData.pos_colony.split(";");
    $.each(array, function(index, value){
        $("#tax_colony").append('<option value="'+value+'">'+value+'</option>');
    });
    $('#cus_commercial_name').val(data.cus_commercial_name);
    $('#cus_contact_first_name').val(data.cus_contact_first_name);
    $('#cus_contact_last_name').val(data.cus_contact_last_name);
    $('#cus_job').val(data.cus_job);
    $('#cus_phone_number').val(data.cus_phone_number);
    $('#cus_cellphone_number').val(data.cus_cellphone_number);
    $('#cus_email').val(data.cus_email);
    $('#cus_address').val(data.cus_address);
    $('#cus_status').val(data.cus_status);
    $('#cus_business_activity').val(data.cus_business_activity);
    $('#tax_rfc').val(data.tax_data.tax_rfc);
    $('#tax_business_name').val(data.tax_data.tax_business_name);
    $('#tax_street').val(data.tax_data.tax_street);
    $('#tax_outdoor_number').val(data.tax_data.tax_outdoor_number);
    $('#tax_apartment_number').val(data.tax_data.tax_apartment_number);
    $('#tax_colony').val(data.tax_data.tax_colony);
    $('#tax_postal_code').val(data.tax_data.tax_postal_code);
    $('#tax_town').val(data.tax_data.tax_town);
    $('#tax_locality').val(data.tax_data.tax_locality);
    $('#tax_state').val(data.tax_data.tax_state);
    $('#tax_country').val(data.tax_data.tax_country);
    $('#tax_tax_email').val(data.tax_data.tax_tax_email);
    $('#tax_legal_representative').val(data.tax_data.tax_legal_representative);
}

function setProduction(data){
    cont = 0;
    $.each(data, function(index, value){        
        if (value.detail_production != null) {
            subtotal = parseFloat(value.det_final_price);
            monthOutlay = monthOutlay + subtotal;
            $("#producciones").append('<tr class="gradeX"><td>' + value.product.pro_name + '</td><td>' + value.detail_production.dpr_recording_date + '</td><td>' + value.detail_production.dpr_proposal_1_date + '</td><td>' + value.detail_production.dpr_proposal_2_date + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm production" type="button" onclick="modalUpdate('+ value.detail_production.dpr_id +')" disabled="true">Modificar</button></div></td></tr>');
            cont++;
        };
    });
    if (cont==0) {
        $("#producciones").append('<tr class="gradeX"><td colspan="5">No existen Producciones para esta Orden de Servicio</td>');
    };
}

function setProyection(ser_duration,ser_start_date,ser_end_date,data){
    cont = 0;
    $('#months_contract').val(ser_duration);
    $('#start_date_contract').val(ser_start_date);
    $('#end_date_contract').val(ser_end_date);
    $.each(data, function(index, value){        
        if (value.product.pro_type == "transmisión") {
            subtotal = parseFloat(value.det_impacts) * parseFloat(value.det_validity) * parseFloat(value.det_final_price);                
            if (value.product.service_proyection.spy_has_show == 0 && value.product.service_proyection.spy_proyection_media == "televisión") {
                subtotal = parseFloat(subtotal) * 10;
            };
            $("#proyecciones").append('<tr class="gradeX"><td>' + value.product.pro_name + '</td><td>' + value.product.service_proyection.spy_outlay + '</td><td>' + value.det_impacts + '</td><td>' + value.det_validity + '</td><td>' + value.det_discount + '</td><td>' + value.det_final_price + '</td><td>' + subtotal + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm proyection" type="button" onclick="modalUpdate('+ value.det_id +')" disabled="true">Modificar</button></div></td></tr>');
            cont++;
            monthOutlay = monthOutlay + subtotal;
        };        
    });
if (cont==0) {
    $("#proyecciones").append('<tr class="gradeX"><td colspan="8">No existen proyecciones para esta Orden de Servicio</td>');
};
}

function setPayments(ser_discount_month,ser_iva,ser_outlay_total,data){
    $('#ser_discount_month').val(ser_discount_month);
    $('#ser_outlay_total').val(ser_outlay_total);
    $('#ser_iva').val(ser_iva);
    $('#amount_kind').val(data.pay_amount_kind);
    $('#amount_cash').val(data.pay_amount_cash);
    var check;
    if (ser_iva != 0) {
        check = true;
    }else{
        check = false;
    }
    $('#has_iva').prop('checked',check);
    cont = 0;
    $.each(data.payment_dates, function(index, value){
        $("#pagos").append('<tr class="gradeX"><td>' + value.pda_amount+ '</td><td>' + value.pda_date + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm payments" type="button" onclick="modalUpdate('+ value.pda_id +')" disabled="true">Modificar</button></div></td></tr>');
        cont++;
    });
    if (cont==0) {
        $("#pagos").append('<tr class="gradeX"><td colspan="5">No existen Producciones para esta Orden de Servicio</td>');
    };
}

function updateCustomer(){
    var customer = {
       "cus_commercial_name" : $('#cus_commercial_name').val(),
       "cus_contact_first_name" : $('#cus_contact_first_name').val(),
       "cus_contact_last_name" : $('#cus_contact_last_name').val(),
       "cus_job" : $('#cus_job').val(),
       "cus_phone_number" : $('#cus_phone_number').val(),
       "cus_cellphone_number" : $('#cus_cellphone_number').val(),
       "cus_email" : $('#cus_email').val(),
       "cus_address" : $('#cus_address').val(),
       "cus_business_activity" : $('#cus_business_activity').val(),         
   };

   var taxData = {
    "tax_rfc" : $('#tax_rfc').val(),
    "tax_business_name" : $('#tax_business_name').val(),
    "tax_street" : $('#tax_street').val(),
    "tax_outdoor_number" : $('#tax_outdoor_number').val(),
    "tax_apartment_number" : $('#tax_apartment_number').val(),
    "tax_colony" : $('#tax_colony').val(),
    "tax_postal_code" : $('#tax_postal_code').val(),
    "tax_town" : $('#tax_town').val(),
    "tax_locality" : $('#tax_locality').val(),
    "tax_state" : $('#tax_state').val(),
    "tax_country" : $('#tax_country').val(),
    "tax_tax_email" : $('#tax_tax_email').val(),
    "tax_legal_representative" : $('#tax_legal_representative').val()
};

var data = {
    "id" : json.customer.cus_id,
    "customer" : customer,
    "tax_data" : taxData
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    url:   updateRoute,
    data: data,
    type:  'post',
    success:  function (data) {
        alert(data.data);        
    }
});
}

function setVariables(){
    totalOutlay = parseFloat(json.ser_outlay_total);
    payments = parseFloat(json.payment_scheme.pay_number_payments);
    iva = parseFloat(json.ser_iva);
    if (iva != 0) {
        hasIVA = true;
    }
    ser_discount = parseFloat(json.ser_discount_month);
    amountKind = parseFloat(json.payment_scheme.pay_amount_kind);
    monthsContract = parseFloat(json.ser_duration);
}

function setEditable(){
    $('.generals').prop("disabled",Boolean(editable.generals));
    $('.payments').prop("disabled",Boolean(editable.payments));
    $('.proyection').prop("disabled",Boolean(editable.proyection));
    $('.production').prop("disabled",Boolean(editable.production));
}

function setAmounts(){
    totalOutlay = monthOutlay * monthsContract;    
    $('#ser_outlay_total').val(totalOutlay);
    $('#amount_cash').val((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2));
    /*for (var i = 0; i < (payments*2); i+=2) {
        $('#payment-'+(i+1)).val((((totalOutlay+iva-amountKind)-((totalOutlay+iva-amountKind)*(ser_discount/100)))/payments).toFixed(2));        
    };*/
}

function prepareIVA(){
    iva = 0;
    $('#ser_iva').val('');
    $('#has_iva').prop('checked',false);
    hasIVA = false;
}

function setEnableMonths(){
    $('#months_contract').prop('disabled',false);
}

function setIVA(){
    if(!hasIVA){
        iva =  parseFloat((totalOutlay * 0.16).toFixed(2));
        $('#ser_iva').val(iva);
        hasIVA = true;
    }else{
        iva = 0;
        $('#ser_iva').val('');
        hasIVA = false;
    }
    setAmounts();
}

function calculateDiscount(){
    ser_discount = parseFloat($('#ser_discount_month').val());
    if($('#ser_discount_month').val() == ''){
        ser_discount = 0;
    }
    setAmounts();
}

function calculateAmounts(){
    amountKind = parseFloat($('#amount_kind').val());
    if($('#amount_kind').val() == ''){
        amountKind = 0;
    }
    setAmounts();
}

function upload(){

}

$(document).ready(function(){
    loadPostalCodes();
    setProduction(json.details_products);
    setProyection(json.ser_duration,json.ser_start_date,json.ser_end_date,json.details_products);
    setPayments(json.ser_discount_month,json.ser_iva,json.ser_outlay_total,json.payment_scheme);
    setEditable();
    setVariables();
});