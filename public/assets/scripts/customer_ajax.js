var id = '';

function create(){
    var customer = {
         "cus_commercial_name" : $('#cus_commercial_name').val(),
         "cus_contact_first_name" : $('#cus_contact_first_name').val(),
         "cus_contact_last_name" : $('#cus_contact_last_name').val(),
         "cus_job" : $('#cus_job').val(),
         "cus_phone_number" : $('#cus_phone_number').val(),
         "cus_cellphone_number" : $('#cus_cellphone_number').val(),
         "cus_email" : $('#cus_email').val(),
         "cus_address" : $('#cus_address').val(),
         "cus_status" : $('#cus_status').val(),
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
        "customer" : customer,
        "tax_data" : taxData
    }

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
        var array = data.dataAddressData['pos_colony'].split(";");
            $.each(array, function(index, value){
                $("#u_tax_colony").append('<option value="'+value+'">'+value+'</option>');
            });
        $('#u_cus_commercial_name').val(data.dataCustomer['cus_commercial_name']);
        $('#u_cus_contact_first_name').val(data.dataCustomer['cus_contact_first_name']);
        $('#u_cus_contact_last_name').val(data.dataCustomer['cus_contact_last_name']);
        $('#u_cus_job').val(data.dataCustomer['cus_job']);
        $('#u_cus_phone_number').val(data.dataCustomer['cus_phone_number']);
        $('#u_cus_cellphone_number').val(data.dataCustomer['cus_cellphone_number']);
        $('#u_cus_email').val(data.dataCustomer['cus_email']);
        $('#u_cus_address').val(data.dataCustomer['cus_address']);
        $('#u_cus_status').val(data.dataCustomer['cus_status']);
        $('#u_cus_business_activity').val(data.dataCustomer['cus_business_activity']);
        $('#u_tax_rfc').val(data.dataTaxData['tax_rfc']);
        $('#u_tax_business_name').val(data.dataTaxData['tax_business_name']);
        $('#u_tax_street').val(data.dataTaxData['tax_street']);
        $('#u_tax_outdoor_number').val(data.dataTaxData['tax_outdoor_number']);
        $('#u_tax_apartment_number').val(data.dataTaxData['tax_apartment_number']);
        $('#u_tax_colony').val(data.dataTaxData['tax_colony']);
        $('#u_tax_postal_code').val(data.dataTaxData['tax_postal_code']);
        $('#u_tax_town').val(data.dataTaxData['tax_town']);
        $('#u_tax_locality').val(data.dataTaxData['tax_locality']);
        $('#u_tax_state').val(data.dataTaxData['tax_state']);
        $('#u_tax_country').val(data.dataTaxData['tax_country']);
        $('#u_tax_tax_email').val(data.dataTaxData['tax_tax_email']);
        $('#u_tax_legal_representative').val(data.dataTaxData['tax_legal_representative']);
        $( "#u_tax_colony" ).prop( "disabled", false );
        $('#updateModal').modal('show');   
    }
});
}

function update(){
    var customer = {
         "cus_commercial_name" : $('#u_cus_commercial_name').val(),
         "cus_contact_first_name" : $('#u_cus_contact_first_name').val(),
         "cus_contact_last_name" : $('#u_cus_contact_last_name').val(),
         "cus_job" : $('#u_cus_job').val(),
         "cus_phone_number" : $('#u_cus_phone_number').val(),
         "cus_cellphone_number" : $('#u_cus_cellphone_number').val(),
         "cus_email" : $('#u_cus_email').val(),
         "cus_address" : $('#u_cus_address').val(),
         "cus_business_activity" : $('#u_cus_business_activity').val(),         
    };

    var taxData = {
        "tax_rfc" : $('#u_tax_rfc').val(),
        "tax_business_name" : $('#u_tax_business_name').val(),
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

    var data = {
        "id" : id,
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
        $("#clientes").html('');
        if (data.data !== null && $.isArray(data.data) && data.data.length>0){
            $.each(data.data, function(index, value){
                $("#clientes").append('<tr class="gradeX"><td>' + value.cus_id + '</td><td>' + value.cus_name + '</td><td>' + value.cus_enterprise + '</td><td>' + value.cus_contact + '</td><td><div class="btn-group" role="group" aria-label="..."><button class="btn btn-info btn-sm" type="button" onclick="modalFiscalData('+ value.cus_id +')">Ver datos fiscales</button><button class="btn btn-warning btn-sm" type="button" onclick="modalUpdate('+ value.cus_id +')">Modificar</button><button class="btn btn-danger btn-sm" type="button" onclick="delet('+ value.cus_id +')">Elminar</button></div></td></tr>');
            });
        }else{
            $("#clientes").append('<tr class="gradeX"><td colspan="5">No existen clientes registrados en la base de datos</td>');
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
    url:   readPostalCodesRoute,
    type:  'post',
    success:  function (data) {
        if (data.data !== null && $.isArray(data.data) && data.data.length>0){
                $.each(data.data, function(index, value){
                    $("#tax_postal_code").append('<option value="'+value.pos_postal_code+'">'+value.pos_postal_code+'</option>');
                    $("#u_tax_postal_code").append('<option value="'+value.pos_postal_code+'">'+value.pos_postal_code+'</option>');
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
        url:   readAddressData,
        type:  'post',
        success:  function (data) {
            $("#u_tax_colony").html('');
            var array = data.data['pos_colony'].split(";");
            $.each(array, function(index, value){
                $("#u_tax_colony").append('<option value="'+value+'">'+value+'</option>');
            });
            $( "#u_tax_colony" ).prop( "disabled", false );
            $('#u_tax_town').val(data.data['pos_town']);
            $('#u_tax_state').val(data.data['pos_state']);
            $('#u_tax_country').val(data.data['pos_country']);  
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

function modalFiscalData(id){
  var data = {
        "id" : id,
    };

   $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

   $.ajax({
    url:   readfiscalData,
    data: data,
    type:  'post',
    success:  function (data) {
        $('#datos_fiscales_titulo').html(data.data['title']);  
        $('#datos_fiscales').html(data.data['body']);
        $('#taxDataModal').modal('show'); 
    }
});  
}

function modalUpdate(id){  
    this.id = id;
    read(id);                   
}

$(document).ready(function(){
    loadTable();
    loadPostalCodes();
});