@extends ('layouts.dashboard')
@section ('page_heading','Clientes')
@section('section')
<div class="col-sm-12">
	<div class="row">
		<div class="col-lg-12">

			<!-- Button trigger modal -->
			<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addCustomer">
				Agregar Cliente
			</button>

			<!-- Modal -->
			<div class="modal fade" id="addCustomer" tabindex="-1" role="dialog" aria-labelledby="addCustomerLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Agregar Cliente</h4>
						</div>
						<div class="modal-body">
							{{ Form::open(array('url' => '', 'id' => 'agregarCliente')) }} 
							<h3><b>Datos Generales</b></h3>
							<hr>
							<div class="form-group">
								{{ Form::label('commercialName','Nombre Comercial')}}
								{{ Form::text('commercialName',null,['class' => 'form-control','id' => 'cus_commercial_name','placeholder' => 'Nombre Comercial'])}}
							</div>
							<div class="form-group">
								{{ Form::label('contact','Nombre de la persona Contacto')}}
								{{ Form::text('contact',null,['class' => 'form-control','id' => 'cus_contact_first_name','placeholder' => 'Contacto'])}}
							</div>
							<div class="form-group">
								{{ Form::label('contact','Apellidos de la persona de contacto')}}
								{{ Form::text('contact',null,['class' => 'form-control','id' => 'cus_contact_last_names','placeholder' => 'Contacto'])}}
							</div>
							<div class="form-group">
								{{ Form::label('job','Puesto')}}
								{{ Form::text('job',null,['class' => 'form-control','id' => 'cus_job','placeholder' => 'Puesto'])}}
							</div>
							<div class="form-group">
								{{ Form::label('phone','Teléfono Fijo')}}
								{{ Form::text('phone',null,['class' => 'form-control','id' => 'cus_phone_number','placeholder' => 'Teléfono Fijo'])}}
							</div>
							<div class="form-group">
								{{ Form::label('cellphoneOrNextel','Celular o Nextel')}}
								{{ Form::text('cellphoneOrNextel',null,['class' => 'form-control','id' => 'cus_cellphone_number','placeholder' => 'Celular o Nextel'])}}
							</div>
							<div class="form-group">
								{{ Form::label('email','Email')}}
								{{ Form::email('email',null,['class' => 'form-control','id' => 'cus_email','placeholder' => 'Email'])}}
							</div>
							<div class="form-group">
								{{ Form::label('address','Dirección')}}
								{{ Form::text('address',null,['class' => 'form-control','id' => 'cus_address','placeholder' => 'Dirección'])}}
							</div>                                                          
							<div class="form-group">
								{{ Form::label('seller','Vendedor Asignado')}}
								{{ Form::select('age', [] ,null, ['class' => 'form-control','id'=>'cus_fk_employee']) }}
							</div>
							<h3><b>Datos Fiscales</b></h3>
							<hr>
							<div class="form-group">
								{{ Form::label('rfc','RFC')}}
								{{ Form::text('rfc',null,['class' => 'form-control','id' => 'tax_rfc','placeholder' => 'RFC'])}}
							</div>
							<div class="form-group"> 
								{{ Form::label('businessName','Razón Social')}}
								{{ Form::text('businessName',null,['class' => 'form-control','id' => 'tax_business_name','placeholder' => 'Razón Social'])}}
							</div>  
							<div class="form-group">
								{{ Form::label('street','Calle')}}
								{{ Form::text('street',null,['class' => 'form-control','id' => 'tax_street','placeholder' => 'Calle'])}}
							</div>
							<div class="form-group">
								{{ Form::label('outsideNumber','Número Exterior')}}
								{{ Form::text('outsideNumber',null,['class' => 'form-control','id' => 'tax_outdoor_number','placeholder' => 'Número Exterior'])}}
							</div>
							<div class="form-group">
								{{ Form::label('insideNumber','Número Interior')}}
								{{ Form::text('insideNumber',null,['class' => 'form-control','id' => 'tax_apartment_number','placeholder' => 'Número Interior'])}}
							</div>
							<div class="form-group">
								{{ Form::label('postCode','Código Postal')}}
								{{ Form::select('postCode', ['null'=>'---Seleccionar Código Postal---'] ,null, ['class' => 'form-control','id'=>'tax_postal_code']) }}
							</div>
							<div class="form-group">
								{{ Form::label('cologne','Colonia')}}
								{{ Form::select('cologne', [''=>'---Seleccionar Colonia---'] ,null, ['class' => 'form-control','id'=>'tax_colony', 'disabled' => 'disabled']) }}
							</div>
							<div class="form-group">
								{{ Form::label('town','Municipio')}}
								{{ Form::text('town',null,['class' => 'form-control','id' => 'tax_town','placeholder' => 'Municipio', 'disabled' => 'disabled'])}}
							</div>
							<div class="form-group">
								{{ Form::label('locality','Localidad')}}
								{{ Form::text('locality',null,['class' => 'form-control','id' => 'tax_locality','placeholder' => 'Localidad'])}}
							</div>
							<div class="form-group">
								{{ Form::label('state','Estado')}}
								{{ Form::text('state',null,['class' => 'form-control','id' => 'tax_state','placeholder' => 'Estado', 'disabled' => 'disabled'])}}
							</div>
							<div class="form-group">
								{{ Form::label('country','País')}}
								{{ Form::text('country',null,['class' => 'form-control','id' => 'tax_country','placeholder' => 'País', 'disabled' => 'disabled'])}}
							</div>
							<div class="form-group">
								{{ Form::label('emailProsecutor','Email Fiscal')}}
								{{ Form::email('emailProsecutor',null,['class' => 'form-control','id' => 'tax_tax_email','placeholder' => 'Email Fiscal'])}}
							</div>
							<div class="form-group">
								{{ Form::label('legalRepresentative','Representante Legal')}}
								{{ Form::text('country',null,['class' => 'form-control','id' => 'tax_legal_representative','placeholder' => 'País'])}}
							</div>
							<div class=text-right>
								{{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'customerCreate()']) }}
								{{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
							</div>
							{{ Form::close() }}                        
						</div>
					</div>
				</div>
			</div>

			<!-- Modal Update-->
			<div class="modal fade" id="updateCustomer" tabindex="-1" role="dialog" aria-labelledby="addCustomerLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Agregar Cliente</h4>
						</div>
						<div class="modal-body">
							{{ Form::open(array('url' => '', 'id' => 'modificarCliente')) }} 
							{{ Form::hidden ('id',null,['id' => 'u_cus_id']) }}
							<h3><b>Datos Generales</b></h3>
							<hr>
							<div class="form-group">
								{{ Form::label('commercialName','Nombre Comercial')}}
								{{ Form::text('commercialName',null,['class' => 'form-control','id' => 'u_cus_commercial_name','placeholder' => 'Nombre Comercial'])}}
							</div>
							<div class="form-group">
								{{ Form::label('contact','Nombre de la persona Contacto')}}
								{{ Form::text('contact',null,['class' => 'form-control','id' => 'u_cus_contact_first_name','placeholder' => 'Contacto'])}}
							</div>
							<div class="form-group">
								{{ Form::label('contact','Apellidos de la persona de contacto')}}
								{{ Form::text('contact',null,['class' => 'form-control','id' => 'u_cus_contact_last_names','placeholder' => 'Contacto'])}}
							</div>
							<div class="form-group">
								{{ Form::label('job','Puesto')}}
								{{ Form::text('job',null,['class' => 'form-control','id' => 'u_cus_job','placeholder' => 'Puesto'])}}
							</div>
							<div class="form-group">
								{{ Form::label('phone','Teléfono Fijo')}}
								{{ Form::text('phone',null,['class' => 'form-control','id' => 'u_cus_phone_number','placeholder' => 'Teléfono Fijo'])}}
							</div>
							<div class="form-group">
								{{ Form::label('cellphoneOrNextel','Celular o Nextel')}}
								{{ Form::text('cellphoneOrNextel',null,['class' => 'form-control','id' => 'u_cus_cellphone_number','placeholder' => 'Celular o Nextel'])}}
							</div>
							<div class="form-group">
								{{ Form::label('email','Email')}}
								{{ Form::email('email',null,['class' => 'form-control','id' => 'u_cus_email','placeholder' => 'Email'])}}
							</div>
							<div class="form-group">
								{{ Form::label('address','Dirección')}}
								{{ Form::text('address',null,['class' => 'form-control','id' => 'u_cus_address','placeholder' => 'Dirección'])}}
							</div>                                                          
							<div class="form-group">
								{{ Form::label('seller','Vendedor Asignado')}}
								{{ Form::select('age', [] ,null, ['class' => 'form-control','id'=>'u_cus_fk_employee']) }}
							</div>
							<h3><b>Datos Fiscales</b></h3>
							<hr>
							<div class="form-group">
								{{ Form::label('rfc','RFC')}}
								{{ Form::text('rfc',null,['class' => 'form-control','id' => 'u_tax_rfc','placeholder' => 'RFC'])}}
							</div>
							<div class="form-group"> 
								{{ Form::label('businessName','Razón Social')}}
								{{ Form::text('businessName',null,['class' => 'form-control','id' => 'u_tax_business_name','placeholder' => 'Razón Social'])}}
							</div>  
							<div class="form-group">
								{{ Form::label('street','Calle')}}
								{{ Form::text('street',null,['class' => 'form-control','id' => 'u_tax_street','placeholder' => 'Calle'])}}
							</div>
							<div class="form-group">
								{{ Form::label('outsideNumber','Número Exterior')}}
								{{ Form::text('outsideNumber',null,['class' => 'form-control','id' => 'u_tax_outdoor_number','placeholder' => 'Número Exterior'])}}
							</div>
							<div class="form-group">
								{{ Form::label('insideNumber','Número Interior')}}
								{{ Form::text('insideNumber',null,['class' => 'form-control','id' => 'u_tax_apartment_number','placeholder' => 'Número Interior'])}}
							</div>
							<div class="form-group">
								{{ Form::label('postCode','Código Postal')}}
								{{ Form::select('postCode', [''=>'---Seleccionar Código Postal---'] ,null, ['class' => 'form-control','id'=>'u_tax_postal_code']) }}
							</div>
							<div class="form-group">
								{{ Form::label('cologne','Colonia')}}
								{{ Form::select('cologne', [''=>'---Seleccionar Colonia---'] ,null, ['class' => 'form-control','id'=>'u_tax_colony', 'disabled' => 'disabled']) }}
							</div>
							<div class="form-group">
								{{ Form::label('town','Municipio')}}
								{{ Form::text('town',null,['class' => 'form-control','id' => 'u_tax_town','placeholder' => 'Municipio', 'disabled' => 'disabled'])}}
							</div>
							<div class="form-group">
								{{ Form::label('locality','Localidad')}}
								{{ Form::text('locality',null,['class' => 'form-control','id' => 'u_tax_locality','placeholder' => 'Localidad'])}}
							</div>
							<div class="form-group">
								{{ Form::label('state','Estado')}}
								{{ Form::text('state',null,['class' => 'form-control','id' => 'u_tax_state','placeholder' => 'Estado', 'disabled' => 'disabled'])}}
							</div>
							<div class="form-group">
								{{ Form::label('country','País')}}
								{{ Form::text('country',null,['class' => 'form-control','id' => 'u_tax_country','placeholder' => 'País', 'disabled' => 'disabled'])}}
							</div>
							<div class="form-group">
								{{ Form::label('emailProsecutor','Email Fiscal')}}
								{{ Form::email('emailProsecutor',null,['class' => 'form-control','id' => 'u_tax_tax_email','placeholder' => 'Email Fiscal'])}}
							</div>
							<div class="form-group">
								{{ Form::label('legalRepresentative','Representante Legal')}}
								{{ Form::text('country',null,['class' => 'form-control','id' => 'u_tax_legal_representative','placeholder' => 'País'])}}
							</div>
							<div class=text-right>
								{{ Form::button('Aceptar',['class' => 'btn btn-success','id' => 'updateCustomerButton']) }}
								{{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
							</div>
							{{ Form::close() }}                        
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-12">
			<table class="table table-striped table-hover table-bordered margin-top20">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre Comercial</th>
						<th>Contacto</th>
						<th>Dirección</th>
						<th>Teléfono Fijo</th>
						<th>Celular o Nextel</th>
						<th>Email</th>
						<th>Razón Social</th>
						<th>RFC</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody id="clientes">
				</tbody>
			</table>
		</div>
	</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
var showCustomersRoute = '{{ action('customerController@postShowCustomers'); }}';
var showEmployeesSelectRoute = '{{ action('customerController@postShowEmployeesSelect'); }}';
var showPostalCodeSelectRoute = '{{ action('customerController@postShowPostalCodeSelect'); }}';
var createCustomerRoute = '{{ action('customerController@postCreateCustomer'); }}';
var deleteRoute =  '{{ action('customerController@postDeleteCustomer'); }}';       
var getCustomerRoute =  '{{ action('customerController@postGetCustomer'); }}';
var updateRoute = '{{ action('customerController@postUpdateCustomer'); }}';
var getPostalData = '{{ action('customerController@postPostalData'); }}';
</script>
<script src="{{ asset("assets/scripts/clientes_ajax.js") }}" type="text/javascript"></script>
@stop

