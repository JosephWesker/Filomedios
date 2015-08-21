var selectedTr = null;

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
                        $("#clientes").append('<tr class="gradeX"><td>'+value.cus_id+'</td><td>'+value.cus_commercial_name+'</td><td>'+value.cus_contact_first_name+' '+value.cus_contact_last_names+'</td><td>'+value.cus_address+'</td><td>'+value.cus_phone_number+'</td><td>'+value.cus_cellphone_number+'</td><td>'+value.cus_email+'</td><td>'+value.cus_business_name+'</td><td>'+value.tax_rfc+'</td></tr>');
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
                if (msg !== null && $.isArray(msg) && msg.length>0){
                    $.each(msg, function(index, value){
                        $("#cus_fk_employee").append('<option value="'+value.emp_id+'">'+value.emp_first_name+' '+value.emp_last_names+'</option>');
                    });
                }else{
                    $("#cus_fk_employee").append('<option value="null">No existen Vendedores</option>');
                    $("#cus_fk_employee").prop('disabled','disabled');
                }
           }
        });
    }
        
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
            "cus_business_name" : $('#cus_business_name').val(),
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
                    $("#clientes").empty();
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
    });