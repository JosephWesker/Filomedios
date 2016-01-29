@extends('layouts.dashboard')
@section('page_heading','Lista de Reproducción')
@section('section')

<!-- jQuery -->
<!--        <script src="{{ asset("assets/stylesheets/proyeccion/jquery.min.js") }}" type="text/javascript"></script>-->

<script src="{{ asset("list/angular.min.js") }}"></script>
<script src="{{ asset("list/angular-drag-and-drop-lists.js") }}"></script>
<link href="{{ asset("list/bootstrap.min.css") }}" rel="stylesheet">
<link href="{{ asset("list/bootstrap-theme.min.css") }}" rel="stylesheet">
<link href="{{ asset("list/framework/demo-framework.css") }}" rel="stylesheet">
<link href="{{ asset("list/simple/simple.css") }}" type = "text/css" rel="stylesheet"> 
<script src="//cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular-route.min.js"></script>
<script src="{{ asset("list/framework/demo-framework.js") }}"></script>
<script src="{{ asset("list/simple/simple.js") }}"></script>



<div class="col-sm-12">
    <div class="row">

        <div ng-app="demo" class="ng-scope">
            <div class="container">
            <!-- ngView:  -->
                <div ng-view="" class="ng-scope">

                </div>
            </div>
        </div>

    </div>
</div>

@stop
