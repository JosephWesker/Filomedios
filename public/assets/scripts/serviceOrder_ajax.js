var selectedTr = null;
var products = null;
var productsRegistered = [];
var monthOutlay = 0;
var totalOutlay = 0;
var payments = 0;
var hasIVA = false;
var iva = 0;
var ser_discount = 0;
var amountKind = 0;
var paymentsData = [];
var monthsContract = 0;
var needProductionRegistry = false;
var productionRegistry = null;
var productionRegistrycount = 0;

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



function addProduct(){
    var row = new Object();
    row.det_fk_product = products[$('#det_fk_product').val()].pro_id;
    row.det_name = products[$('#det_fk_product').val()].pro_name;
    row.det_final_price = products[$('#det_fk_product').val()].pro_outlay;
    row.det_type = products[$('#det_fk_product').val()].pro_type;
    if (products[$('#det_fk_product').val()].pro_type=='Producción') {
        if (products[$('#det_fk_product').val()].production.prd_need_dates) {
            needProductionRegistry = true;
            productionRegistrycount++;
        };
    };
    row.det_amount = $('#pso_amount').val();
    row.det_subtotal = parseFloat(row.det_final_price) * parseFloat(row.det_amount);
    productsRegistered[productsRegistered.length] = row;
    $('#det_fk_product').val("null");
    $('#pso_amount').val("null");
    loadProductsTable();

}

function loadProductsTable(){
    $("#products").html('');
    monthOutlay = 0;
    if (productsRegistered !== null && $.isArray(productsRegistered) && productsRegistered.length>0){
        $('#start_date_contract').prop('disabled',false);        
        $.each(productsRegistered, function(index, value){            
            monthOutlay += parseFloat(value.det_subtotal);
            var text = '<tr class="gradeX"><td>'+value.det_name+'</td><td>'+value.det_final_price+'</td><td>'+value.det_subtotal+'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-danger btn-sm" type="button" onclick="delet('+index+')">Eliminar</button></div></td></tr>';
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
    monthOutlay = parseFloat(monthOutlay.toFixed(2));
    $('#ser_total').val(monthOutlay);
    setAmounts();
    prepareIVA();
}

function delet(index){
    if (productsRegistered[index].det_type == "Producción") {
        productionRegistrycount--;
        if (productionRegistrycount == 0) {
            needProductionRegistry = false;
        };
    };
    productsRegistered.splice(index,1);
    loadProductsTable();
}


function addProductionRegistry(){
    productionRegistry = {
        'dpr_recording_date' : $('#dpr_recording_date').val(),
        'dpr_proposal_1_date' : $('#dpr_proposal_1_date').val(),
        'dpr_proposal_2_date' : $('#dpr_proposal_2_date').val()
    } 
    $('#productionRegistry').modal('hide');
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
        'pay_number_payments' : payments,
        'detail_product' : productsRegistered,
        'needProductionRegistry' : needProductionRegistry,
        'productionRegistry' : productionRegistry,
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
    $("#products").append('<tr class="gradeX"><td colspan="9">no existen productos para esta orden de servicio</td>');
});