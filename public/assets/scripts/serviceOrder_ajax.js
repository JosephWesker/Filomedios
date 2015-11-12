var selectedTr = null;
var products = null;
var packages = null;
var productsRegistered = [];
var shows = null;
var businessUnit = null;
var monthOutlay = 0;
var totalOutlay = 0;
var payments = 0;
var hasIVA = false;
var iva = 0;
var ser_discount = 0;
var amountKind = 0;
var paymentsData = [];
var json = null;
var monthsContract = 0;

function loadCustomers(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   loadCustomersRoute,
        type:  'post',
        success:  function (data) {
            $("#clientes").html('');
            if (data.data !== null && $.isArray(data.data) && data.data.length>0){
                $.each(data.data, function(index, value){
                    $("#clientes").append('<tr class="gradeX"><td>'+ value.cus_id +'</td><td>'+ value.cus_commercial_name +'</td><td>'+ value.cus_contact +'</td><td>'+ value.tax_business_name +'</td><td>'+ value.tax_rfc +'</td></tr>');
                });
                tableSelect();
            }else{
                $("#clientes").append('<tr class="gradeX"><td colspan="7">No existen Clientes registrados en la base de datos</td>');
            }
        }
    });
}

function tableSelect(){
    var table = document.getElementById("clientes");
    var tr = table.getElementsByTagName('tr');
    for (var i=0;i<tr.length;i++){
        tr[i].addEventListener('click',function(){
            if(selectedTr !== null){
                selectedTr.removeAttr('style');
            }
            selectedTr = $(this); 
            selectedTr.css('background-color', 'orange');
        });
    }
}

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

function loadSelects(){
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
            $.each(data.businessUnit, function(index, value) {   
                $('#set_business_unit')
                .append($("<option></option>")
                 .attr("value",value.bus_id)
                 .html(value.bus_name));
            });
            $.each(data.show, function(index, value) {   
                $('#set_show')
                .append($("<option></option>")
                 .attr("value",value.sho_id)
                 .html(value.sho_name));
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

function toDiscount_number(){
    var price = parseFloat($('#pro_outlay').val());
    var discount = parseFloat($('#det_discount').val());
    if(discount<=100){
        $('#det_discount_number').val((price-(price*(discount/100))).toFixed(2));
    }else{
        $('#det_discount_number').val((price+(price*((discount-100)/100))).toFixed(2));
    }
}

function toDiscount(){
    var price = parseFloat($('#pro_outlay').val());
    var discount = parseFloat($('#det_discount_number').val());
    if(price>=discount){
        $('#det_discount').val((100-((discount*100)/price)).toFixed(2));
    }else{
        $('#det_discount').val(((((discount)*100)/price)).toFixed(2));
    }
}

function addProduct(){
    var row = new Object();
    row.det_fk_product = products[$('#det_fk_product').val()].pro_id;
    row.det_name = products[$('#det_fk_product').val()].pro_name;
    
    row.det_impacts = $('#det_impacts').val();
    row.det_validity = $('#det_validity').val();
    row.det_discount = $('#det_discount').val();
    row.det_final_price = $('#det_discount_number').val();    
    
    if(products[$('#det_fk_product').val()].pro_type == "transmisión"){        

        if (products[$('#det_fk_product').val()].pro_extra.spy_has_show) {
            row.det_fk_show = $('#det_fk_show').val();
        };

        if (products[$('#det_fk_product').val()].pro_extra.spy_has_transmission_scheme) {
            row.det_has_transmission_scheme = null;
        };

        row.det_fk_business_unit = $('#det_fk_business_unit').val();

        row.det_subtotal = parseFloat(row.det_impacts) * parseFloat(row.det_validity) * parseFloat(row.det_final_price);
        
        if (products[$('#det_fk_product').val()].pro_extra.spy_has_show == 0 && products[$('#det_fk_product').val()].pro_extra.spy_proyection_media == "televisión") {
            row.det_subtotal = parseFloat(row.det_subtotal) * 10;
        };

    }else{
        if (products[$('#det_fk_product').val()].pro_extra.spr_has_production_registry) {
            row.det_has_production_registry = null;
        };

        row.det_subtotal = row.det_final_price;
    }

    productsRegistered[productsRegistered.length] = row;
    loadProductsTable();

    $('#det_fk_product').val("null");
    $('#pro_outlay').val("null");
    setFormVisible();
}

function loadProductsTable(){
    $("#products").html('');
    monthOutlay = 0;
    if (productsRegistered !== null && $.isArray(productsRegistered) && productsRegistered.length>0){
        $('#start_date_contract').prop('disabled',false);        
        $.each(productsRegistered, function(index, value){            
            monthOutlay += parseFloat(value.det_subtotal);

            var text = '<tr class="gradeX"><td>'+value.det_name+'</td><td>'+value.det_impacts+'</td><td>'+value.det_validity+'</td><td>'+value.det_final_price+'</td><td>'+value.det_subtotal+'</td><td><div class="btn-group" role="group" aria-label="...">';

            if (value.hasOwnProperty('det_has_transmission_scheme')) {
                text = text + '<button class="btn btn-info btn-sm" type="button" onclick="setTransmissionScheme('+index+')">Definir Esquema transmisión</button>';
            }

            if (value.hasOwnProperty('det_has_production_registry')) {
                text = text + '<button class="btn btn-info btn-sm" type="button" onclick="setProductionRegistry('+index+')">Definir Fechas Producción</button>';
            }
            if (value.hasOwnProperty('det_fk_business_unit')) {
                if (value.det_fk_business_unit == null || value.det_fk_business_unit == 'null') {
                    text = text + '<button class="btn btn-warning btn-sm" type="button" onclick="setBusinessUnit('+index+')">Definir Unidad de Negocio</button>';
                }
            }

            if (value.hasOwnProperty('det_fk_show')) {
                if (value.det_fk_show == null || value.det_fk_show == 'null') {
                    text = text + '<button class="btn btn-warning btn-sm" type="button" onclick="setShow('+index+')">Definir Programa</button>';
                };                
            }

            text = text + '<button class="btn btn-danger btn-sm" type="button" onclick="delet('+index+')">Eliminar</button></div></td></tr>';
            $("#products").append(text);
        });
    }else{
        $('#start_date_contract').prop('disabled',true);
        $('#months_contract').prop('disabled',true);        
        $('#start_date_contract').val("null");
        $('#months_contract').val("null");
        $('#end_date_contract').val("null");
        $('#ser_total').val("null");
        $("#products").append('<tr class="gradeX"><td colspan="9">no existen productos para esta orden de servicio</td>');
    }
    $('#addProduct').modal('hide');
    $('#addPackage').modal('hide');
    monthOutlay = parseFloat(monthOutlay.toFixed(2));
    $('#ser_total').val(monthOutlay);
    setAmounts();
    prepareIVA();
}

function delet(index){
    productsRegistered.splice(index,1);
    loadProductsTable();
}

function setProductionRegistry(index){
    $('#dpr_recording_date').val("null");
    $('#dpr_proposal_1_date').val("null");
    $('#dpr_proposal_2_date').val("null");

    if(productsRegistered[index].det_has_production_registry != null){
        $('#dpr_recording_date').val(productsRegistered[index].det_has_production_registry.dpr_recording_date);
        $('#dpr_proposal_1_date').val(productsRegistered[index].det_has_production_registry.dpr_proposal_1_date);
        $('#dpr_proposal_2_date').val(productsRegistered[index].det_has_production_registry.dpr_proposal_2_date);
    }
    $('#productionRegistryIndex').val(index);
    $('#productionRegistry').modal('show');
}

function addProductionRegistry(){
    var index = $('#productionRegistryIndex').val();
    var productionRegistry = {
        'dpr_recording_date' : $('#dpr_recording_date').val(),
        'dpr_proposal_1_date' : $('#dpr_proposal_1_date').val(),
        'dpr_proposal_2_date' : $('#dpr_proposal_2_date').val()
    }
    productsRegistered[index].det_has_production_registry = productionRegistry;
    $('#productionRegistryIndex').val("null");    
    $('#productionRegistry').modal('hide');
}

function setTransmissionScheme(index){
    $('#tra_monday').prop('checked',false);
    $('#tra_tuesday').prop('checked',false);
    $('#tra_wednesday').prop('checked',false);
    $('#tra_thrusday').prop('checked',false);
    $('#tra_friday').prop('checked',false);
    $('#tra_saturday').prop('checked',false);
    $('#tra_sunday').prop('checked',false);
    
    if(productsRegistered[index].det_has_transmission_scheme != null){
        $('#tra_monday').prop('checked',Boolean(productsRegistered[index].det_has_transmission_scheme.tra_monday));
        $('#tra_tuesday').prop('checked',Boolean(productsRegistered[index].det_has_transmission_scheme.tra_tuesday));
        $('#tra_wednesday').prop('checked',Boolean(productsRegistered[index].det_has_transmission_scheme.tra_wednesday));
        $('#tra_thrusday').prop('checked',Boolean(productsRegistered[index].det_has_transmission_scheme.tra_thrusday));
        $('#tra_friday').prop('checked',Boolean(productsRegistered[index].det_has_transmission_scheme.tra_friday));
        $('#tra_saturday').prop('checked',Boolean(productsRegistered[index].det_has_transmission_scheme.tra_saturday));
        $('#tra_sunday').prop('checked',Boolean(productsRegistered[index].det_has_transmission_scheme.tra_sunday));   
    }
    $('#transmissionSchemeIndex').val(index);
    $('#transmissionScheme').modal('show');
}

function addTransmissionScheme(){
    var index = $('#transmissionSchemeIndex').val();
    var TransmissionScheme = {
            'tra_monday' : $('#tra_monday').is(':checked'),
            'tra_tuesday' : $('#tra_tuesday').is(':checked'),
            'tra_wednesday' : $('#tra_wednesday').is(':checked'),
            'tra_thursday' : $('#tra_thursday').is(':checked'),
            'tra_friday' : $('#tra_friday').is(':checked'),
            'tra_saturday' : $('#tra_saturday').is(':checked'),
            'tra_sunday' : $('#tra_sunday').is(':checked')    
    }
    productsRegistered[index].det_has_transmission_scheme = TransmissionScheme;
    $('#transmissionSchemeIndex').val("null");    
    $('#transmissionScheme').modal('hide');
}

function loadPackages(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   loadPackageRoute,
        type:  'post',
        success:  function (data) {            
            if (data.data !== null && $.isArray(data.data) && data.data.length>0){
                $.each(data.data, function(index, value) {   
                    $('#det_add_package')
                    .append($("<option></option>")
                     .attr("value",value.pac_id)
                     .html(value.pac_name));
                });                
            }
        }
    });  
}


function addPackage(){
   var data = {
        'id': $('#det_add_package').val()
   }

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   loadPackageDetailRoute,
        data: data,
        type:  'post',
        success:  function (data) {            
            if (data.data !== null && $.isArray(data.data) && data.data.length>0){
                $.each(data.data, function(index, value) {   
                    productsRegistered.push(value);
                });                
            }
            $('#det_add_package').val("null");
            loadProductsTable();
        }
    });  
}

function setShow(index){
    $('#showIndex').val(index);
    $('#setShow').modal('show');
}

function addShow(){
   var index = $('#showIndex').val();
   productsRegistered[index].det_fk_show = $('#set_show').val();
   $('#setShow').modal('hide');
   $('#set_show').val("null");
   loadProductsTable();
}

function setBusinessUnit(index){
    $('#businessUnitIndex').val(index);
    $('#setBusinessUnit').modal('show');
}

function addBusinessUnit(){
   var index = $('#businessUnitIndex').val();
   productsRegistered[index].det_fk_business_unit = $('#set_business_unit').val();
   $('#setBusinessUnit').modal('hide');
   $('#set_business_unit').val("null");
   loadProductsTable();
}

function setAmounts(){
    totalOutlay = monthOutlay * monthsContract;    
    $('#ser_outlay_total').val(totalOutlay);
    $('#amount_cash').val((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2));
    for (var i = 0; i < (payments*2); i+=2) {
        $('#payment-'+(i+1)).val((((totalOutlay+iva-amountKind)-((totalOutlay+iva-amountKind)*(ser_discount/100)))/payments).toFixed(2));        
    };
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

function getPayments(){
    paymentsData = [];
    for (var i = 1; i < (payments*2); i+=2) {
        row = new Object(); 
        row.pda_date = $('#payment-'+(i+1)).val();
        row.pda_amount = parseFloat($('#payment-'+(i)).val());
        paymentsData[paymentsData.length] = row;
    };
}

function sendServiceOrder(){
    getPayments();

    var data = {
        'ser_discount_month' : ser_discount,
        'ser_outlay_total' : totalOutlay,
        'ser_iva' : iva,
        'ser_duration' : parseInt($('#months_contract').val()),
        'ser_start_date': $("#start_date_contract").val(),
        'ser_end_date' : $("#end_date_contract").val(),
        'ser_fk_customer' : selectedTr.children().eq(0).html(),
        'pay_amount_cash': parseFloat((totalOutlay+iva-amountKind-((totalOutlay+iva-amountKind)*(ser_discount/100))).toFixed(2)),
        'pay_amount_kind' : amountKind,
        'pay_number_payments' : payments,
        'detail_product' : productsRegistered,
        'payment_date' : paymentsData
    };    

    json = JSON.stringify(data);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   createServiceOrderRoute,
        data: data,
        type:  'post',
        success:  function (data) {            
            
        }
    });      
}


$(document).ready(function(){
    loadCustomers();
    loadProductsData();
    loadSelects();
    loadPackages();    
    $("#products").append('<tr class="gradeX"><td colspan="9">no existen productos para esta orden de servicio</td>');
});