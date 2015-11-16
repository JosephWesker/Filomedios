@extends('layouts.dashboard')
@section('page_heading','Evaluación de Vendedores')
@section('section')
<div class="col-sm-12">
    <div class="row">
        <div class="col-lg-12">    
            <div class="full-width-tabs">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active fill_width"><a href="#accepted" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Registro de Metas</a></li>
                    <li role="presentation" class="fill_width"><a href="#pending" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Consultar Resultados</a></li>
                    <li role="presentation" class="fill_width"><a href="#rejected" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Proyecciones</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="accepted" aria-labelledby="home-tab">
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="pending" aria-labelledby="profile-tab">
                        
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="rejected" aria-labelledby="profile-tab">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset("assets/scripts/jquery-2.1.4.min.js") }}" type="text/javascript"></script>
    <script>       

    </script>
    <script src="{{ asset("assets/scripts/orderManager_ajax.js") }}" type="text/javascript"></script>
       
@stop
