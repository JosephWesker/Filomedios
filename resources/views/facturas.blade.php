@extends('layouts.dashboard')
@section('page_heading','Facturas')
@section('section')
<div class="col-sm-12">
    <div class="row">                
        <div class="col-lg-12">    
            <div class="full-width-tabs">

                <!-- Modal -->
                <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="addCustomer">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Registrar Factura o Nota de Venta/h4>
                            </div>
                            <div class="modal-body">
                                {{ Form::open(array('url' => '#', 'id' => 'agregar')) }} 
                                <div class="form-group">
                                    {{ Form::label('cfdi','CFDI o Número de Nota')}}
                                    {{ Form::text('cfdi',null,['class' => 'form-control','id' => 'ind_content','placeholder' => 'CFDI o Número de Nota'])}}
                                </div>
                                <div class=text-right>
                                    {{ Form::button('Guardar',['class' => 'btn btn-success','onclick' => 'sendData()']) }}
                                    {{ Form::button('Cancelar',['class' => 'btn btn-danger','data-dismiss' => 'modal']) }}
                                </div>                        
                                {{ Form::close() }}                        
                            </div>
                        </div>
                    </div>
                </div>

                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active fill_width"><a href="#outstanding" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Por Facturar</a></li>
                    <li role="presentation" class="fill_width"><a href="#overcome" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Nota de Venta</a></li>                    
                </ul>                
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="outstanding" aria-labelledby="home-tab">
                     <div class="col-lg-12">
                        <h3><b>Pagos pendientes de Facturación</b></h3> 
                        <hr>
                        <table class="table table-striped table-hover table-bordered margin-top20">
                            <thead>
                                <tr>
                                    <th>Monto Total</th>
                                    <th>Fecha</th>
                                    <th>Orden de Servicio</th>
                                    <th>Cliente</th>
                                    <th>Registrar Factura</th>                      
                                </tr>
                            </thead>
                            <tbody id="factura">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="overcome" aria-labelledby="profile-tab">
                    <div class="col-lg-12">
                        <h3><b>Pagos pendientes de Nota de Venta</b></h3> 
                        <hr>
                        <table class="table table-striped table-hover table-bordered margin-top20">
                            <thead>
                                <tr>
                                   <th>Monto Total</th>
                                   <th>Fecha</th>
                                   <th>Orden de Servicio</th>
                                   <th>Cliente</th>
                                   <th>Registrar Nota</th>          
                               </tr>
                           </thead>
                           <tbody id="nota">

                           </tbody>                        
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>       
    var readPaymentsRoute = '{{ action('treasuryController@postReadPaymentsToInvoice'); }}';
</script>
<script src="{{ asset("assets/scripts/invoice_ajax.js") }}" type="text/javascript"></script>

@stop
