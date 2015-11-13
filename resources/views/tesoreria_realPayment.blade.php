@extends('layouts.dashboard')
@section('page_heading','Pago: '.$pda_id.' de la Orden de Servicio: '.$ser_id)
@section('section')
<div class="col-sm-12">
    <div class="row"> 
        <div class="col-lg-12" {{ ($hasIVA) ? '' : 'style="display:none"' }} >    
            <h4><b>Importante este pago requiere factura</b></h4>
        </div>               
        <div class="col-lg-12">    
            <h3><b>Datos del Cliente</b></h3> 
            <hr>
            <div id="datos_fiscales" class="col-lg-6">
                {{ $clienteColum1 }}
            </div>
            <div id="datos_fiscales" class="col-lg-6">
                {{ $clienteColum2 }}
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
    var paymentsServiceOrderRoute = '{{ route('tesoreria'); }}';
</script>
<script src="{{ asset("assets/scripts/treasury_payment_ajax.js") }}" type="text/javascript"></script>

@stop
