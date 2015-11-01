var selectedTr = null;
var products = null;
var packages = null;
var productsRegistered = [];
var shows = null;
var businessUnit = null;

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
                $('#det_fk_business_unit')
                .append($("<option></option>")
                 .attr("value",value.bus_id)
                 .html(value.bus_name));
            });        
        }
    });
}

function setFormVisible(){
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

function addProduct(){
    var row = [];
    row['det_fk_product'] = products[$('#det_fk_product').val()].pro_id;
    row['det_name'] = products[$('#det_fk_product').val()].pro_name;
    row['det_fk_business_unit'] = $('#det_fk_business_unit').val();
    row['det_fk_show'] = $('#det_fk_show').val();
    row['det_impacts'] = $('#det_impacts').val();
    row['det_validity'] = $('#det_validity').val();
    row['det_discount'] = $('#det_discount').val();
    row['det_final_price'] = $('#det_discount_number').val();    
    if(products[$('#det_fk_product').val()].pro_type == "transmisión"){
        row['det_subtotal'] = parseFloat(row['det_impacts']) * parseFloat(row['det_validity']) * parseFloat(row['det_final_price']);
        if (products[$('#det_fk_product').val()].pro_extra.spy_has_show == 0 && products[$('#det_fk_product').val()].pro_extra.spy_proyection_media == "televisión") {
            row['det_subtotal'] = parseFloat(row['det_subtotal']) * 10;
        };
    }else{
        row['det_subtotal'] = row['det_final_price'];
    }
    productsRegistered.push(row);
    loadProductsTable();   
}

function loadProductsTable(){
    $("#products").html('');
    if (productsRegistered !== null && $.isArray(productsRegistered) && productsRegistered.length>0){
        $.each(productsRegistered, function(index, value){
            $("#products").append('<tr class="gradeX"><td>'+value.det_name+'</td><td>'+value.det_impacts+'</td><td>'+value.det_validity+'</td><td>'+value.det_final_price+'</td><td>'+value.det_subtotal+'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+value.pad_id+')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('+value.pad_id+')">Elminar</button></div></td></tr>');
        });
    }else{
        $("#products").append('<tr class="gradeX"><td colspan="9">no existen productos para esta orden de servicio</td>');
    }
    $('#addProduct').modal('hide');
}

$(document).ready(function(){
    loadCustomers();
    loadProductsData();
    loadSelects();
    $("#products").append('<tr class="gradeX"><td colspan="9">no existen productos para esta orden de servicio</td>');
});