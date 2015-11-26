var monthOutlay = 0;
var totalOutlay = 0;
var payments = 0;
var hasIVA = false;
var iva = 0;
var ser_discount = 0;
var amountKind = 0;
var monthsContract = 0;
var newPayments = [];
var changingPayment = null;
var row = null;
var show = null;
var businessUnit = null;

var products = null;

var indexProyection = null;

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

/*function loadSelects(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   loadSelectsRoute,
        type:  'post',
        success:  function (data) {
            shows = data.show;
            businessUnit = data.businessUnit;                                
        }
    });
}*/

function loadProductsData(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   loadProductsDataRoute,
        type:  'post',
        success:  function (data) {
            products = data.data;
            $.each(data.data, function(index, value) {   
                $('#det_fk_product')
                .append($("<option></option>")
                   .attr("value",index)
                   .text(value.pro_name));
            });
        }
    });
}

function setFormVisible(){
    if ($('#det_fk_product').val() != "null") {
        if (products[parseInt($('#det_fk_product').val())].pro_type == 'transmisión'){
            $('#proyection_data').show();
            $('#det_fk_business_unit').html('');
            $('#det_fk_business_unit')
            .append($("<option></option>")
             .attr("value","null")
             .html("---Seleccionar Unidad de Negocio---"));
            $.each(businessUnit, function(index, value) {   
                $('#det_fk_business_unit')
                .append($("<option></option>")
                 .attr("value",value.bus_id)
                 .html(value.bus_name));
            });
            if (products[$('#det_fk_product').val()].pro_extra.spy_has_show) {
                $('#fk_show').show();
                $('#det_fk_show').html('');
                $('#det_fk_show')
                .append($("<option></option>")
                 .attr("value","null")
                 .html("---Seleccionar Programa---"));
                $.each(shows, function(index, value) {   
                    $('#det_fk_show')
                    .append($("<option></option>")
                     .attr("value",value.sho_id)
                     .html(value.sho_name));
                }); 
            }else{
                $('#fk_show').hide();
            }
            $('#pro_outlay').val(products[parseInt($('#det_fk_product').val())].pro_extra.spy_outlay);
        }else{
            $('#proyection_data').hide();
            $('#fk_show').hide();
            $('#pro_outlay').val(products[parseInt($('#det_fk_product').val())].pro_extra.spr_outlay);        
        }
    }
    $('#det_fk_business_unit').val("null");
    $('#det_fk_show').val("null");
    $('#det_impacts').val("null");
    $('#det_validity').val("null");
    $('#det_discount').val("null");
    $('#det_discount_number').val("null");            
}

function u_setFormVisible(ind){
    $('#u_det_fk_business_unit').html('');
    $('#u_det_fk_business_unit')
    .append($("<option></option>")
     .attr("value","null")
     .html("---Seleccionar Unidad de Negocio---"));
    $.each(businessUnit, function(index, value) {   
        $('#u_det_fk_business_unit')
        .append($("<option></option>")
         .attr("value",value.bus_id)
         .html(value.bus_name));
    });
    if (json.details_products[ind].product.service_proyection.spy_has_show) {
        $('#u_fk_show').show();
        $('#u_det_fk_show').html('');
        $('#u_det_fk_show')
        .append($("<option></option>")
         .attr("value","null")
         .html("---Seleccionar Programa---"));
        $.each(shows, function(index, value) {   
            $('#u_det_fk_show')
            .append($("<option></option>")
             .attr("value",value.sho_id)
             .html(value.sho_name));
        });
        $('u_det_fk_show').val(json.details_products[ind].det_fk_show); 
    }else{
        $('#u_fk_show').hide();
    }        
    $('#u_det_fk_business_unit').val("null");
    $('#u_det_fk_show').val("null");
    $('#u_det_impacts').val("null");
    $('#u_det_validity').val("null");
    $('#u_det_discount').val("null");
    $('#u_det_discount_number').val("null");            
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
    $("#producciones").html('');
    $("#producciones").append('<tr class="gradeX"><td>' + data.dpr_recording_date + '</td><td>' + data.dpr_proposal_1_date + '</td><td>' + data.dpr_proposal_2_date + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm production" type="button" onclick="editProductionDates(\''+data.dpr_ser_id+'\')" disabled="true">Modificar</button></div></td></tr>');            

}

function setProyection(ser_duration,ser_start_date,ser_end_date,data){
    cont = 0;
    $('#months_contract2').val(ser_duration);
    $('#start_date_contract').val(ser_start_date);
    $('#end_date_contract').val(ser_end_date);
    $("#proyecciones").html('');
    $.each(data, function(index, value){        
        subtotal = parseFloat(value.pso_subtotal);                
        $("#proyecciones").append('<tr class="gradeX"><td>' + value.product.pro_name + '</td><td>' + value.product.pro_outlay + '</td><td>' + value.pso_amount + '</td><td>' + value.pso_subtotal + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm proyection" type="button" onclick="editProyection('+ index+')" disabled="true">Modificar</button></div></td></tr>');
        cont++;
        monthOutlay = monthOutlay + subtotal;        
    });
    if (cont==0) {
        $("#proyecciones").append('<tr class="gradeX"><td colspan="8">No existen proyecciones para esta Orden de Servicio</td>');
    };
}

function setPayments(ser_discount_month,ser_iva,ser_outlay_total,data){
    $('#ser_discount_month').val(ser_discount_month);
    $('#ser_outlay_total').val(ser_outlay_total);
    $('#ser_iva').val(ser_iva);
    var check;
    if (ser_iva != 0) {
        check = true;
    }else{
        check = false;
    }
    $('#has_iva').prop('checked',check);
    cont = 0;
    $("#pagos").html('');
    $.each(data, function(index, value){
        $("#pagos").append('<tr class="gradeX"><td>' + value.pda_amount+ '</td><td>' + value.pda_date + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm payments" type="button" onclick="editDate('+ index +',\'old\')" disabled="true">Modificar</button><button class="btn btn-danger btn-sm payments" type="button" onclick="delateDate('+ value.pda_id +',\'old\')" disabled="true">Eliminar</button></div></td></tr>');
        cont++;
    });
    if (cont==0) {
        $("#pagos").append('<tr class="gradeX"><td colspan="5">No existen pagos para esta Orden de Servicio</td>');
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
    totalOutlay = parseFloat(json.ser_outlay);
    payments = parseFloat(json.payments_date.length);
    iva = parseFloat(json.ser_iva);
    if (iva != 0) {
        hasIVA = true;
    }
    ser_discount = parseFloat(json.ser_discount_month);
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
    if (hasIVA) {
        iva = totalOutlay*0.16;
        $('#ser_iva').val(iva);
    };    
    $('#ser_outlay_total').val(totalOutlay);
    $('#amount_cash').val((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2));
    setPayments2();    
}

function setPayments2(){
    $("#pagos").html('');
    cont = 0;
    $.each(json.payments_date, function(index, value){
        value.pda_amount = (((totalOutlay+iva-amountKind)-((totalOutlay+iva-amountKind)*(ser_discount/100)))/payments).toFixed(2);  
        $("#pagos").append('<tr class="gradeX"><td>' + value.pda_amount+ '</td><td>' + value.pda_date + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm payments" type="button" onclick="editDate('+ index +',\'old\')">Modificar</button><button class="btn btn-danger btn-sm payments" type="button" onclick="delateDate('+ value.pda_id +',\'old\')" >Eliminar</button></div></td></tr>');        
        cont++;
    });
    if (cont<payments) {
        $.each(newPayments, function(index, value){
            value.pda_amount = (((totalOutlay+iva-amountKind)-((totalOutlay+iva-amountKind)*(ser_discount/100)))/payments).toFixed(2);  
            $("#pagos").append('<tr class="gradeX"><td>' + value.pda_amount + '</td><td>' + value.pda_date + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm payments" type="button" onclick="editDate('+ index +',\'new\')">Modificar</button><button class="btn btn-danger btn-sm payments" type="button" onclick="delateDate('+ index +',\'new\')" >Eliminar</button></div></td></tr>');        
        });
    };
    setEditable(); 
}

function prepareIVA(){
    iva = 0;
    $('#ser_iva').val('');
    $('#has_iva').prop('checked',false);
    hasIVA = false;
}

function setEnableMonths(){
    $('#months_contract2').prop('disabled',false);
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

function addPayment(){
    payments++;
    var payment = new Object();
    payment.pda_amount = 0;
    payment.pda_date = $('#newPayment').val();
    newPayments[newPayments.length] = payment;
    $('#addPayment').modal('hide');
    setPayments2();
}

function editDate(id,type){
    if (type == 'old') {
        changingPayment = json.payments_date[id];        
    }else{
        changingPayment = newPayments[id];  
    }
    $('#setDate').val(changingPayment.pda_date);
    $('#editPayment').modal('show');
}

function editPayment(){
    changingPayment.pda_date = $('#setDate').val();
    $('#editPayment').modal('hide');
    setPayments2();
}

function updatePayment(){
    var data = {
        'serviceOrder' : json.ser_id,
        'discount' : ser_discount,
        'totalOutlay' : totalOutlay,
        'iva' : iva,
        'amountCash' : parseFloat((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2)),
        'amountKind' : amountKind,
        'numberPayments' : payments,
        'paymentsold' : json.payments_date,
        'paymentsnew' : newPayments
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   updatePaymentsRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert('Datos para pago guardados con exito');
            json = data.data;
            adressData = data.adressData;
            if (json.detail_production!=null) {
               setProduction(json.detail_production); 
           }else{
               $("#producciones").append('<tr class="gradeX"><td colspan="5">No existen producciones para esta Orden de Servicio</td>'); 
           };
           setProyection(json.ser_duration,json.ser_start_date,json.ser_end_date,json.fil_product_fil_service_order);
           setPayments(json.ser_discount_month,json.ser_iva,json.ser_outlay, json.payments_date);
           setEditable();
           setVariables();
           newPayments = [];     
       }
   });
}

function delateDate(id,type){
    if (type == 'old') {
        var data = {
            'id' : id
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:   delatePaymentsRoute,
            data: data,
            type:  'post',
            success:  function (data) {
                alert('Datos para pago guardados con exito');
                json = data.data;
                adressData = data.adressData;
                if (json.detail_production!=null) {
                 setProduction(json.detail_production); 
             }else{
                 $("#producciones").append('<tr class="gradeX"><td colspan="5">No existen producciones para esta Orden de Servicio</td>'); 
             };
             setProyection(json.ser_duration,json.ser_start_date,json.ser_end_date,json.fil_product_fil_service_order);
             setPayments(json.ser_discount_month,json.ser_iva,json.ser_outlay, json.payments_date);
             setEditable();
             setVariables();       
             newPayments = [];
         }
     });           
    }else{
        payments--;
        newPayments.splice(id,1);
        alert('Pago Eliminado');
        setPayments2();
    }
}

function updateOrderDuration(){
    monthsContract =  parseInt($('#months_contract2').val())
    setAmounts();
    var data = {
        'id' : json.ser_id,
        'ser_duration' :  parseInt($('#months_contract2').val()),
        'ser_start_date': $("#start_date_contract").val(),
        'ser_end_date' : $("#end_date_contract").val(),
        'totalOutlay' : totalOutlay,
        'iva' : iva,
        'amountCash' : parseFloat((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2)),        
        'paymentAmount' : (((totalOutlay+iva-amountKind)-((totalOutlay+iva-amountKind)*(ser_discount/100)))/payments).toFixed(2)
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   updateOrderDurationRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert(data.data);        
        }
    });            
}

function addProduct(){
    row = new Object();
    row.det_fk_product = products[$('#det_fk_product').val()].pro_id;
    row.det_name = products[$('#det_fk_product').val()].pro_name;
    row.det_final_price = products[$('#det_fk_product').val()].pro_outlay;
    row.det_type = products[$('#det_fk_product').val()].pro_type;    
    row.det_amount = $('#pso_amount').val();
    row.det_subtotal = parseFloat(row.det_final_price) * parseFloat(row.det_amount);    
    $('#det_fk_product').val("null");
    $('#pso_amount').val("null");
    monthOutlay = monthOutlay + parseFloat(row.det_subtotal);
    setAmounts();
    checkifneedExtras();
}

function checkifneedExtras(){
    //if (row.hasOwnProperty('det_has_transmission_scheme')) {        
     //   setTransmissionScheme();
    //}else{
        if (row.det_type == 'Producción') {
            setProductionRegistry();
        }else{
            sendProduct();
        }
    //} 
}

function setProductionRegistry(){
    $('#dpr_recording_date').val("null");
    $('#dpr_proposal_1_date').val("null");
    $('#dpr_proposal_2_date').val("null");    
    $('#productionRegistry').modal('show');
}
function setTransmissionScheme(){
    $('#tra_monday').prop('checked',false);
    $('#tra_tuesday').prop('checked',false);
    $('#tra_wednesday').prop('checked',false);
    $('#tra_thrusday').prop('checked',false);
    $('#tra_friday').prop('checked',false);
    $('#tra_saturday').prop('checked',false);
    $('#tra_sunday').prop('checked',false);
    $('#transmissionScheme').modal('show');
}

function addProductionRegistry(){
    var productionRegistry = {
        'dpr_recording_date' : $('#dpr_recording_date').val(),
        'dpr_proposal_1_date' : $('#dpr_proposal_1_date').val(),
        'dpr_proposal_2_date' : $('#dpr_proposal_2_date').val()
    }
    row.det_has_production_registry = productionRegistry;    
    $('#productionRegistry').modal('hide');
    sendProduct();
}
function addTransmissionScheme(){
    var TransmissionScheme = {
        'tra_monday' : $('#tra_monday').is(':checked'),
        'tra_tuesday' : $('#tra_tuesday').is(':checked'),
        'tra_wednesday' : $('#tra_wednesday').is(':checked'),
        'tra_thursday' : $('#tra_thursday').is(':checked'),
        'tra_friday' : $('#tra_friday').is(':checked'),
        'tra_saturday' : $('#tra_saturday').is(':checked'),
        'tra_sunday' : $('#tra_sunday').is(':checked')    
    }
    row.det_has_transmission_scheme = TransmissionScheme;
    $('#transmissionScheme').modal('hide');
    sendProduct();
}

function toDiscount_number(){
    var price = parseFloat($('#pro_outlay').val());
    var discount = parseFloat($('#det_discount').val());
    if(discount<=100){
        $('#det_discount_number').val(price-(price*(discount/100)));
    }else{
        $('#det_discount_number').val(price+(price*((discount-100)/100)));
    }
}

function toDiscount(){
    var price = parseFloat($('#pro_outlay').val());
    var discount = parseFloat($('#det_discount_number').val());
    if(price>=discount){
        $('#det_discount').val(100-((discount*100)/price));
    }else{
        $('#det_discount').val((((discount)*100)/price));
    }
}

function u_toDiscount_number(){
    var price = parseFloat($('#u_pro_outlay').val());
    var discount = parseFloat($('#u_det_discount').val());
    if(discount<=100){
        $('#u_det_discount_number').val((price-(price*(discount/100))).toFixed(2));
    }else{
        $('#u_det_discount_number').val((price+(price*((discount-100)/100))).toFixed(2));
    }
}

function u_toDiscount(){
    var price = parseFloat($('#u_pro_outlay').val());
    var discount = parseFloat($('#u_det_discount_number').val());
    if(price>=discount){
        $('#u_det_discount').val((100-((discount*100)/price)).toFixed(2));
    }else{
        $('#u_det_discount').val(((((discount)*100)/price)).toFixed(2));
    }
}

function sendProduct(){    
    var data = {
        'row' : row,
        'ser_id' : json.ser_id,
        'totalOutlay' : totalOutlay,
        'iva' : iva,
        'amountCash' : parseFloat((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2)),        
        'paymentAmount' : (((totalOutlay+iva-amountKind)-((totalOutlay+iva-amountKind)*(ser_discount/100)))/payments).toFixed(2)
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   addProductRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert('Producto registro');
            json = data.data;
            adressData = data.adressData;
            if (json.detail_production!=null) {
               setProduction(json.detail_production); 
           }else{
               $("#producciones").append('<tr class="gradeX"><td colspan="5">No existen producciones para esta Orden de Servicio</td>'); 
           };
           setProyection(json.ser_duration,json.ser_start_date,json.ser_end_date,json.fil_product_fil_service_order);
           setPayments(json.ser_discount_month,json.ser_iva,json.ser_outlay, json.payments_date);
           setEditable();
           setVariables();
           $('#det_fk_product').val("null");
           $('#pro_outlay').val("null");
           setFormVisible();   
       }
   });   
}

function editProductionDates(index){
    $('#u_productionRegistryIndex').val(index);
    $('#u_dpr_recording_date').val(json.detail_production.dpr_recording_date);
    $('#u_dpr_proposal_1_date').val(json.detail_production.dpr_proposal_1_date);
    $('#u_dpr_proposal_2_date').val(json.detail_production.dpr_proposal_2_date);
    $('#detailProduction').modal('show');
}

function setProductionDates(){
    var data = {
        'dpr_id' : $('#u_productionRegistryIndex').val(),
        'dpr_recording_date' : $('#u_dpr_recording_date').val(),
        'dpr_proposal_1_date' : $('#u_dpr_proposal_1_date').val(),
        'dpr_proposal_2_date' : $('#u_dpr_proposal_2_date').val()
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   updateProductionDatesRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert('Fechas guardadas con exito');
            json = data.data;
            adressData = data.adressData;
            if (json.detail_production!=null) {
             setProduction(json.detail_production); 
         }else{
             $("#producciones").append('<tr class="gradeX"><td colspan="5">No existen producciones para esta Orden de Servicio</td>'); 
         };
         setProyection(json.ser_duration,json.ser_start_date,json.ser_end_date,json.fil_product_fil_service_order);
         setPayments(json.ser_discount_month,json.ser_iva,json.ser_outlay, json.payments_date);
         setEditable();
         setVariables();
         $('#detailProduction').modal('hide');        
     }
 });    
}

function editProyection(index){
    indexProyection = index;
    $('#u_productid').val(json.fil_product_fil_service_order[index].pso_id);
    $('#u_pso_amount').val(json.fil_product_fil_service_order[index].pso_amount);
    $('#editProyection').modal('show');
}

function setNewProyection(){
    var det_subtotal = parseFloat(json.fil_product_fil_service_order[indexProyection].pso_subtotal);
    var det_new_subtotal = parseFloat(json.fil_product_fil_service_order[indexProyection].product.pro_outlay) * parseFloat($('#u_pso_amount').val());

    monthOutlay = monthOutlay - det_subtotal + det_new_subtotal;

    setAmounts();
    
    var data = {
        'det_id' : $('#u_productid').val(),
        'det_fk_business_unit' : $('#u_det_fk_business_unit').val(),
        'det_impacts' : $('#u_det_impacts').val(),
        'det_validity' : $('#u_det_validity').val(),
        'det_discount' : $('#u_det_discount').val(),
        'det_final_price' : det_new_subtotal,
        'det_u_pso_amount': $('#u_pso_amount').val(),
        'ser_id' : json.ser_id,
        'totalOutlay' : totalOutlay,
        'iva' : iva,
        'amountCash' : parseFloat((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2)),        
        'paymentAmount' : (((totalOutlay+iva-amountKind)-((totalOutlay+iva-amountKind)*(ser_discount/100)))/payments).toFixed(2)
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   updateProductRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert('Producto actualizado exitosamente');
            json = data.data;
            adressData = data.adressData;
            if (json.detail_production!=null) {
               setProduction(json.detail_production); 
           }else{
               $("#producciones").append('<tr class="gradeX"><td colspan="5">No existen producciones para esta Orden de Servicio</td>'); 
           };
           setProyection(json.ser_duration,json.ser_start_date,json.ser_end_date,json.fil_product_fil_service_order);
           setPayments(json.ser_discount_month,json.ser_iva,json.ser_outlay, json.payments_date);
           setEditable();
           setVariables();
           $('#editProyection').modal('hide');        
       }
   });
}

function getFiles(){
    var data = {
        'serviceOrder' : json.ser_id
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   readFilesRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            $("#filesoncloud").html('');
            if (data.data !== null && $.isArray(data.data) && data.data.length>0){
                $.each(data.data, function(index, value){
                    $("#filesoncloud").append('<tr class="gradeX"><td>' + value.name + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm production" type="button" onclick="downloadFile(\''+ value.path +'\')" disabled="true">Descargar</button><button class="btn btn-danger btn-sm production" type="button" onclick="delateFile(\''+ value.path +'\')" disabled="true">Eliminar</button></div></td></tr>');
                });
            }else{
                $("#filesoncloud").append('<tr class="gradeX"><td colspan="2">No existen Archivos en el servidor para esta orden</td>');
            }
            setEditable();
        }
    });    
}

function downloadFile(path){
    var url = downloadFilesRoute+'/download/'+path;
    window.open(url,'_blank');  
}

function delateFile(path){
    var data = {
        'path' : path
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   delateFilesRoute,
        data: data,
        type:  'post',
        success:  function (data) {
            alert(data.data);
            getFiles();
        }
    });    
}

$(document).ready(function(){
    loadPostalCodes();
    loadProductsData();
    if (json.detail_production!=null) {
       setProduction(json.detail_production); 
   }else{
       $("#producciones").append('<tr class="gradeX"><td colspan="5">No existen producciones para esta Orden de Servicio</td>'); 
   };
   setProyection(json.ser_duration,json.ser_start_date,json.ser_end_date,json.fil_product_fil_service_order);
   setPayments(json.ser_discount_month,json.ser_iva,json.ser_outlay, json.payments_date);
   setEditable();
   setVariables();    
   getFiles();

   $("#months_contract2").on("change", function () {
    var date = new Date($("#start_date_contract").val()),
    months = parseInt($("#months_contract2").val());

    if (!isNaN(date.getTime())) {
        date.setMonth(date.getMonth() + months);
        $("#end_date_contract").val(date.toInputFormat());            
    } else {
            //     alert("Invalid Date");  
        }
    });

   $("#uploadButton").click(function(){
    event.preventDefault();
    var data = new FormData();
    $.each($('#filetoupload')[0].files, function(i, file) {
        data.append('file-'+i, file); 
    });
    data.append('idServiceOrder',json.ser_id);

    $.ajax({
        xhr: function(){
            var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function(evt){
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //Do something with upload progress
                        //console.log(percentComplete);
                        $('#fileProgress').val(percentComplete);
                    }
                }, false);
                //Download progress
                xhr.addEventListener("progress", function(evt){
                    if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        //Do something with download progress
                        console.log(percentComplete);
                    }
                }, false);                
                return xhr;
            },
            url:loadFilesRoute,
            type: "post",   // usualmente post o get var tipo = JSON.stringify(arrayC);
            dataType: "html",
            data: data,
            cache: false,
            contentType: false,
            processData: false
        }).done(function(res){
            getFiles();
            $('#fileProgress').val(0);
        });
    });
});