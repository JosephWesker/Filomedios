@extends('layouts.dashboard')
@section('page_heading','Gestor de Archivos')
@section('section')
<link rel="stylesheet" href="{{ asset("assets/stylesheets/filemanager.css") }}" />
<div class="filemanager">
	<div class="search">
		<input type="search" placeholder="Find a file.." />
	</div>

	<div class="breadcrumbs"></div>
		<ul class="data">
			
		</ul>
		<div class="nothingfound">
			<div class="nofiles">
				
			</div>
			<span>No files here.</span>
		</div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
<script>
	var scanRoute = '{{ action('serviceOrderController@getFileManager'); }}';
	var pathOriginal = '{{ str_replace('\\', '/', storage_path('app/produccionFile')); }}';
	var downloadFilesRoute = '{{ route('gestor de ordenes de servicios'); }}';
</script>
<script src="{{ asset("assets/scripts/filemanager.js") }}" type="text/javascript"></script>
@stop
