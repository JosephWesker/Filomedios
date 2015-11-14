var hasInvoice = false;
var newInvoice = true;
var paid = 0;
var total = parseFloat(payment.pda_amount);

function setTables(){
	var hasCFDIS = false;
	$("#realPayment").html('');
	$("#totals").html('');
	$("#cfdis").html('');
	if (payment.real_payments !== null && $.isArray(payment.real_payments) && payment.real_payments.length>0){
		$.each(payment.real_payments , function(index, value){
			$("#realPayment").append('<tr class="gradeX"><td>' + value.rpa_id + '</td><td>' + value.rpa_amount + '</td><td>' + value.rpa_date + '</td><td>' + value.rpa_method + '</td><td>' + value.rpa_account + '</td></tr>');
			paid = paid + parseFloat(value.rpa_amount);
			if (value.invoice_data != null) {
				$("#cfdis").append('<tr class="gradeX"><td>' + value.invoice_data.ind_cfdi + '</td></tr>');
				hasCFDIS = true;
			};
		});
	}else{
		$("#realPayment").append('<tr class="gradeX"><td colspan="5">No existen pagos registrados en la base de datos</td></tr>');
	}
	if (!hasCFDIS) {
		$("#cfdis").append('<tr class="gradeX"><td>No existen facturas registradas en la base de datos</td></tr>');
	};
	$("#totals").append('<tr class="gradeX"><td>' + total + '</td><td>' + paid + '</td><td>' + (total-paid) + '</td></tr>');
}

function checkForAccount(){
	$("#rpa_account").val('');
	if($("#rpa_method").val()!='contado'){		
		$("#account").show();
	}else{
		$("#account").hide();
	}
}

function checkForInvoice(){
	if($("#rpa_fk_invoice_data").val()!='nueva'){		
		$("#invoice").hide();
		newInvoice = false;
	}else{
		$("#invoice").show();
		newInvoice = true;
	}
}

function setListeners(){
	$('#rpa_has_invoice').change(function() {
		if ($('#rpa_has_invoice').is(':checked')) {
			$("#hasInvoice").show();
			hasInvoice = true;
		}else{
			$("#hasInvoice").hide();
			hasInvoice = false;
		}
		$("#rpa_fk_invoice_data").val('nueva');
		$("#ind_cfdi").val('');
	});
}

function readCFDIS(){
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$.ajax({
		url:   readCFDISRoute,
		type:  'post',
		success:  function (data) {
			$.each(data.data, function(index, value) {   
				$('#rpa_fk_invoice_data')
				.append($("<option></option>")
					.attr("value",value.ind_id)
					.html(value.ind_cfdi));
			});
		}
	});
}

function sendPayment(){
	if (parseFloat($("#rpa_amount").val())>(total-paid)) {
		alert('Cantidad Superior a la cantidad adeudada, porfavor modifique la cantidad');
	}else{
		var data = {
			'rpa_fk_payment_date' : payment.pda_id,
			'rpa_amount' : $("#rpa_amount").val(),
			'rpa_method' : $("#rpa_method").val(),
			'rpa_account' : $("#rpa_account").val(),
			'rpa_has_invoice' : hasInvoice,
			'new_invoice' : newInvoice,
			'ind_id' : $("#rpa_fk_invoice_data").val(), 
			'ind_cfdi' : $("#ind_cfdi").val()
		};

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$.ajax({
			url:   sendPaymentRoute,
			type:  'post',
			data: data,
			success:  function (data) {
				alert(data.data);
				location.reload();
			}
		});
	};
}

$(document).ready(function(){
	setTables();
	setListeners();
	readCFDIS();
	if (payment.pda_status == 'pagado') { $('#buttonPay').prop('disabled',true) };
});