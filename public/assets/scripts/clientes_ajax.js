function loadTable(){
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
                    $("#clientes").append('<tr class="gradeX"><td>'+value.cus_id+'</td><td>'+value.cus_commercial_name+'</td><td>'+value.cus_contact_first_name+' '+value.cus_contact_last_names+'</td><td>'+value.cus_address+'</td><td>'+value.cus_phone_number+'</td><td>'+value.cus_cellphone_number+'</td><td>'+value.cus_email+'</td><td>'+value.tax_business_name+'</td><td>'+value.tax_rfc+'</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+ value.cus_id +')">Editar</button><button class="btn btn-danger btn-sm" type="button" onclick="deleteCustomer('+ value.cus_id +')">Eliminar</button></div></td></tr>');
                });
            }else{
                $("#clientes").append('<tr class="gradeX"><td colspan="10">No existen clientes registrados en la base de datos</td>');
            }
        }
    });
}    

function loadSellers(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   showEmployeesSelectRoute,
        type:  'post',
        success:  function (msg) {
            $("#cus_fk_employee").html('');
            $("#u_cus_fk_employee").html('');
            if (msg !== null && $.isArray(msg) && msg.length>0){
                $.each(msg, function(index, value){
                    $("#cus_fk_employee").append('<option value="'+value.emp_id+'">'+value.emp_first_name+' '+value.emp_last_names+'</option>');
                    $("#u_cus_fk_employee").append('<option value="'+value.emp_id+'">'+value.emp_first_name+' '+value.emp_last_names+'</option>');
                });
            }else{
                $("#cus_fk_employee").append('<option value="null">No existen Vendedores</option>');
                $("#cus_fk_employee").prop('disabled','disabled');
                $("#u_cus_fk_employee").append('<option value="null">No existen Vendedores</option>');
                $("#u_cus_fk_employee").prop('disabled','disabled');
            }
        }
    });
}

function loadPostalCodes(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url:   showPostalCodeSelectRoute,
        type:  'post',
        success:  function (msg) {
            if (msg !== null && $.isArray(msg) && msg.length>0){
                $.each(msg, function(index, value){
                    $("#tax_postal_code").append('<option value="'+value.ps_postal_code+'">'+value.ps_postal_code+'</option>');
                    $("#u_tax_postal_code").append('<option value="'+value.ps_postal_code+'">'+value.ps_postal_code+'</option>');
                });
            }else{
                $("#tax_postal_code").prop('disabled','disabled');
                $("#u_tax_postal_code").prop('disabled','disabled');
            }
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
        url:   getPostalData,
        type:  'post',
        success:  function (msg) {
            $("#tax_colony").html('');
            var array = msg['ps_colony'].split(";");
            $.each(array, function(index, value){
                $("#tax_colony").append('<option value="'+value+'">'+value+'</option>');
            });
            $( "#tax_colony" ).prop( "disabled", false );
            $('#tax_town').val(msg['ps_town']);
            $('#tax_state').val(msg['ps_state']);
            $('#tax_country').val(msg['ps_country']);  
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

$( "#u_tax_postal_code" ).change(function() {
    var tax_postal_code = $('#u_tax_postal_code').val();
    if(tax_postal_code != "null"){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $.ajax({
        data: {'id' : tax_postal_code },
        url:   getPostalData,
        type:  'post',
        success:  function (msg) {
            $("#u_tax_colony").html('');
            var array = msg['ps_colony'].split(";");
            $.each(array, function(index, value){
                $("#u_tax_colony").append('<option value="'+value+'">'+value+'</option>');
            });
            $( "#u_tax_colony" ).prop( "disabled", false );
            $('#u_tax_town').val(msg['ps_town']);
            $('#u_tax_state').val(msg['ps_state']);
            $('#u_tax_country').val(msg['ps_country']);  
        }
    });
  }else{    
    $("#u_tax_colony").html('');
    $("#u_tax_colony").append('<option value="">--Seleccionar Colonia---</option>');
    $("#u_tax_colony" ).prop( "disabled", true );
    $('#u_tax_town').val('');
    $('#u_tax_state').val('');
    $('#u_tax_country').val('');  
}
});

function customerCreate(){

    var values = {
        "cus_commercial_name" : $('#cus_commercial_name').val(),
        "cus_contact_first_name" : $('#cus_contact_first_name').val(),
        "cus_contact_last_names" : $('#cus_contact_last_names').val(),
        "cus_job" : $('#cus_job').val(),
        "cus_phone_number" : $('#cus_phone_number').val(),
        "cus_cellphone_number": $('#cus_cellphone_number').val(),
        "cus_email" : $('#cus_email').val(),
        "cus_address" : $('#cus_address').val(),
        "tax_business_name" : $('#tax_business_name').val(),
        "cus_fk_employee" : $('#cus_fk_employee').val(),
        "tax_rfc" : $('#tax_rfc').val(),
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
    loadSellers();
    loadPostalCodes();        
});

function deleteCustomer(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        data: {'id' : id },
        url:   deleteRoute,
        type:  'post',
        success:  function (msg) {
            alert(msg);
            loadTable();
        }
    });
}

function modalUpdate(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        data: {'id' : id },
        url:   getCustomerRoute,
        type:  'post',
        success:  function (msg) { 
            var tax_postal_code = msg['tax_postal_code'];
            if(tax_postal_code != "null"){
              $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

              $.ajax({
                data: {'id' : tax_postal_code },
                url:   getPostalData,
                type:  'post',
                success:  function (datas) {
                    $("#u_tax_colony").html('');
                    var array = datas['ps_colony'].split(";");
                    $.each(array, function(index, value){
                        $("#u_tax_colony").append('<option value="'+value+'">'+value+'</option>');
                    });
                    $( "#u_tax_colony" ).prop( "disabled", false );
                    $('#u_tax_colony').val(msg['tax_colony']);
                    $('#u_tax_town').val(datas['ps_town']);
                    $('#u_tax_state').val(datas['ps_state']);
                    $('#u_tax_country').val(datas['ps_country']);  
                }
            });
          }else{    
            $("#u_tax_colony").html('');
            $("#u_tax_colony").append('<option value="">--Seleccionar Colonia---</option>');
            $("#u_tax_colony" ).prop( "disabled", true );
            $('#u_tax_town').val('');
            $('#u_tax_state').val('');
            $('#u_tax_country').val('');  
        }

        $('#u_cus_id').val(id);       
        $('#u_cus_commercial_name').val(msg['cus_commercial_name']);
        $('#u_cus_contact_first_name').val(msg['cus_contact_first_name']);
        $('#u_cus_contact_last_names').val(msg['cus_contact_last_names']);
        $('#u_cus_job').val(msg['cus_job']);
        $('#u_cus_phone_number').val(msg['cus_phone_number']);
        $('#u_cus_cellphone_number').val(msg['cus_cellphone_number']);
        $('#u_cus_email').val(msg['cus_email']);
        $('#u_cus_address').val(msg['cus_address']);
        $('#u_tax_business_name').val(msg['tax_business_name']);
        $('#u_cus_fk_employee').val(msg['cus_fk_employee']);
        $('#u_tax_rfc').val(msg['tax_rfc']);
        $('#u_tax_street').val(msg['tax_street']);
        $('#u_tax_outdoor_number').val(msg['tax_outdoor_number']);
        $('#u_tax_apartment_number').val(msg['tax_apartment_number']);
        $('#u_tax_postal_code').val(msg['tax_postal_code']);
        $('#u_tax_town').val(msg['tax_town']);
        $('#u_tax_locality').val(msg['tax_locality']);
        $('#u_tax_state').val(msg['tax_state']);
        $('#u_tax_country').val(msg['tax_country']);
        $('#u_tax_tax_email').val(msg['tax_tax_email']);
        $('#u_tax_legal_representative').val(msg['tax_legal_representative']);
        $('#updateCustomer').modal('show');
    }
});
}


var button2 = document.getElementById("updateCustomerButton");
button2.addEventListener('click', function(){
    var values = {
        "cus_id" : $('#u_cus_id').val(),
        "tax_id" : $('#u_cus_id').val(),
        "cus_commercial_name" : $('#u_cus_commercial_name').val(),
        "cus_contact_first_name" : $('#u_cus_contact_first_name').val(),
        "cus_contact_last_names" : $('#u_cus_contact_last_names').val(),
        "cus_job" : $('#u_cus_job').val(),
        "cus_phone_number" : $('#u_cus_phone_number').val(),
        "cus_cellphone_number": $('#u_cus_cellphone_number').val(),
        "cus_email" : $('#u_cus_email').val(),
        "cus_address" : $('#u_cus_address').val(),
        "tax_business_name" : $('#u_tax_business_name').val(),
        "cus_fk_employee" : $('#u_cus_fk_employee').val(),
        "tax_rfc" : $('#u_tax_rfc').val(),
        "tax_street" : $('#u_tax_street').val(),
        "tax_outdoor_number" : $('#u_tax_outdoor_number').val(),
        "tax_apartment_number" : $('#u_tax_apartment_number').val(),
        "tax_colony" : $('#u_tax_colony').val(),
        "tax_postal_code" : $('#u_tax_postal_code').val(),
        "tax_town" : $('#u_tax_town').val(),
        "tax_locality" : $('#u_tax_locality').val(),
        "tax_state" : $('#u_tax_state').val(),
        "tax_country" : $('#u_tax_country').val(),
        "tax_tax_email" : $('#u_tax_tax_email').val(),
        "tax_legal_representative" : $('#u_tax_legal_representative').val()
    };

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        data:   values,
        url:   updateRoute,
        type:  'post',
        success:  function (msg) {
            $("#u_tax_colony").html('');
            $("#u_tax_colony").append('<option value="">--Seleccionar Colonia---</option>');
            $("#u_tax_colony" ).prop( "disabled", true );
            alert(msg);
            loadTable();
            $('#updateCustomer').modal('hide');
            $(':input', '#modificarCliente')
            .not(':button, :submit, :reset, :hidden')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');                             
        }
    });
});
