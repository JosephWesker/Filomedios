@extends('layouts.dashboard')
@section('page_heading','Panel Principal')
@section('section')
           
<div class="col-lg-12">
	<div class="col-lg-6">
		<div  style="width:100%; height:400px;" id='charts1'>

		</div>
		<br>
		<div  style="width:100%; height:400px;" id='charts3'>

		</div>
	</div>
	<div class="col-lg-6">
		<div  style="width:100%; height:400px;" id='charts2'>

		</div>
		<br>
		<div  style="width:100%; height:400px;" id='charts4'>

		</div>
	</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script src="{{ asset("assets/scripts/Highcharts-4.1.9/js/highcharts.js") }}" type="text/javascript"></script>
<script src="{{ asset("assets/scripts/Highcharts-4.1.9/js/modules/exporting.js") }}" type="text/javascript"></script>
<script>
var chartSalesRoute = "{{ action('homeController@postLoadChartSales'); }}";
var chartPaymentsRoute = "{{ action('homeController@postLoadChartPayments'); }}";
var chartSalersRoute = "{{ action('homeController@postGetSalesByEmployee'); }}";
</script>
<script src="{{ asset("assets/scripts/home_ajax.js") }}" type="text/javascript"></script>
@stop
