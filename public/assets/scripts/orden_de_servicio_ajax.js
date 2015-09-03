var selectedTr = null;
var productCounter = 0;
var productArray = [];

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
                        $("#clientes").append('<tr class="gradeX"><td>'+value.cus_id+'</td><td>'+value.cus_commercial_name+'</td><td>'+value.cus_contact_first_name+' '+value.cus_contact_last_names+'</td><td>'+value.cus_address+'</td><td>'+value.cus_phone_number+'</td><td>'+value.cus_cellphone_number+'</td><td>'+value.cus_email+'</td><td>'+value.tax_business_name+'</td><td>'+value.tax_rfc+'</td></tr>');
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

    function addProduct(){
        
    }
    
    $(document).ready(function(){
        loadTable();   
    });