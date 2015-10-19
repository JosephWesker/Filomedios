var id = '';

function create(){
    var data = {
        "pad_fk_package" : $('#pad_fk_package').text(),
        "pad_fk_product" : $('#pad_fk_product').val(),
        "pad_impacts" : $('#pad_impacts').val(),
        "pad_validity" : $('#pad_validity').val(),
        "pad_discount" : $('#pad_discount').val()
    };

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$.ajax({
    url:   createRoute,
    data: data,
    type:  'post',
    success:  function (data) {
        alert(data.data);
        loadTable();
        $('#add').modal('hide');
        $(':input', '#agregar')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .removeAttr('checked')
        .removeAttr('selected');        
    }
});
}

function read(id){
    var data = {
        "id" : id,
    };

   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $.ajax({
    url:   readRoute,
    data: data,
    type:  'post',
    success:  function (data) {
        $('#u_pac_name').val(data.data['pac_name']);
        $('#u_pac_description').val(data.data['pac_description']); 
        $('#updateModal').modal('show');   
    }
});
}

function update(){
    var data = {
        "id" : this.id,
        "pac_name" : $('#u_pac_name').val(),
        "pac_description" : $('#u_pac_description').val()
    };

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
            loadTable();
            $('#updateModal').modal('hide'); 
            $(':input', '#actualizar')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected')
        }
    });
}

function delet(id){
    var data = {
        "id" : id,
    };

   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $.ajax({
    url:   deleteRoute,
    data: data,
    type:  'post',
    success:  function (data) {
        alert(data.data);
        loadTable();
    }
});
}

function loadTable(){
   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $.ajax({
    url:   readAllRoute,
    type:  'post',
    success:  function (data) {
        $("#paquetes").html('');
        if (data.data !== null && $.isArray(data.data) && data.data.length>0){
            $.each(data.data, function(index, value){
                $("#paquetes").append('<tr class="gradeX"><td>'+data.data['pad_id']+'</td><td>'+data.data['pro_name']+'</td><td>'+data.data['pro_outlay']+'</td><td>'+data.data['pad_impacts']+'</td><td>'+data.data['pad_validity']+'</td><td>'+data.data['pad_discount']+'</td><td>'+data.data['pad_finalPrice']+'</td><td>'+data.data['pad_subtotal']+'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+data.data['pad_id']+')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('+data.data['pad_id']+')">Elminar</button></div></td></tr>');
            });
        }else{
            $("#paquetes").append('<tr class="gradeX"><td colspan="9">no existen detalles para este Paquete</td>');
        }
    }
});
}

function modalUpdate(id){  
    this.id = id;
    read(id);                   
}


function loadProducts(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   loadProductsRoute,
        type:  'post',
        success:  function (data) {  
            $.each(data.data, function(index, value) {   
                $('#pad_fk_product')
                .append($("<option></option>")
                   .attr("value",value.pro_id)
                   .text(value.pro_name));
                $('#u_pad_fk_product')
                .append($("<option></option>")
                   .attr("value",value.pro_id)
                   .text(value.pro_name));
            });        
        }
    });
}

function toDiscount_number(){
    var price = parseFloat($('#pro_outlay').val());
    var discount = parseFloat($('#pad_discount').val());
    if(discount<=100){
        $('#pad_discount_number').val(price-(price*(discount/100)));
    }else{
        $('#pad_discount_number').val(price+(price*((discount-100)/100)));
    }
}

function toDiscount(){
    var price = parseFloat($('#pro_outlay').val());
    var discount = parseFloat($('#pad_discount_number').val());
    if(price>=discount){
        $('#pad_discount').val(100-((discount*100)/price));
    }else{
        $('#pad_discount').val((((discount)*100)/price));
    }
}

function u_toDiscount_number(){
    var price = parseFloat($('#u_pro_outlay').val());
    var discount = parseFloat($('#u_pad_discount').val());
    if(discount<=100){
        $('#u_pad_discount_number').val(price-(price*(discount/100)));
    }else{
        $('#u_pad_discount_number').val(price+(price*((discount-100)/100)));
    }
}

function u_toDiscount(){
    var price = parseFloat($('#u_pro_outlay').val());
    var discount = parseFloat($('#u_pad_discount_number').val());
    if(price>=discount){
        $('#u_pad_discount').val(100-((discount*100)/price));
    }else{
        $('#u_pad_discount').val((((discount-100)*100)/price));
    }
}

function loadListeners(){
    $( '#pad_fk_product' ).change(function() {
        var data = {
            "pro_id" : $('#pad_fk_product').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:   loadPriceProductRoute,
            data: data,
            type:  'post',
            success:  function (data) {  
                  $('#pro_outlay').val(data);
                  toDiscount_number();
            }
        });
    });

    $( '#u_pad_fk_product' ).change(function() {
        var data = {
            "pro_id" : $('#u_pad_fk_product').val(),
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url:   loadPriceProductRoute,
            data: data,
            type:  'post',
            success:  function (data) {  
                  $('#u_pro_outlay').val(data);
                  u_toDiscount_number();                  
            }
        });
    });
}

$(document).ready(function(){
    loadProducts();
    loadListeners();
});
