var selectedTr = null;

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

$(document).ready(function(){
    loadCustomers();
});