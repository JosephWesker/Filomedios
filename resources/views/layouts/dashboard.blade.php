@extends('layouts.plane')

@section('body')

<!--        <link rel="stylesheet" href="{{ asset("assets/stylesheets/custom.css") }}" />-->


<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div id="logo-filomedios"></div>
            <a class="navbar-brand" href="{{ url ('') }}">Filomedios</a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
<!--            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Ayer</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Ayer</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <strong>John Smith</strong>
                                <span class="pull-right text-muted">
                                    <em>Hace 3 días</em>
                                </span>
                            </div>
                            <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Leer todo</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                 /.dropdown-messages 
            </li>-->
            <!-- /.dropdown -->

            <!-- /.dropdown -->
<!--            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-comment fa-fw"></i> Evento mas reciente
                                <span class="pull-right text-muted small">1 min</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-twitter fa-fw"></i> Evento
                                <span class="pull-right text-muted small">6 min</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-envelope fa-fw"></i> Evento
                                <span class="pull-right text-muted small">8 min</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-tasks fa-fw"></i> Evento
                                <span class="pull-right text-muted small">12 min</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <div>
                                <i class="fa fa-upload fa-fw"></i> Evento mas antiguo
                                <span class="pull-right text-muted small">24 min</span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a class="text-center" href="#">
                            <strong>Ver todo</strong>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
                 /.dropdown-alerts 
            </li>-->
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    {{ Session::get('user') }}<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="{{ route('perfil'); }}"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ action('loginController@getLogoff'); }}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->        


        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
<!--                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </li>-->
                    <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                        <a href="{{ url ('') }}"><i class="fa fa-dashboard fa-fw"></i> Panel Principal</a>
                    </li>                    
                    <li {{ (Request::is('*comercializacion') ? 'class="active"' : '') }}>
                        <a href="{{ url ('comercializacion') }}"><i class="fa fa-file-text fa-fw"></i> Comercialización</a>
                        <ul class="nav nav-second-level">
                            @if (Session::get('type') == 'administrador' || Session::get('type') == 'tesoreria' || Session::get('type') == 'vendedor' || Session::get('type') == 'gerente de ventas')
                            <li {{ (Request::is('*nueva_orden_de_servicio') ? 'class="active"' : '') }}>
                                <a href="{{ url ('nueva_orden_de_servicio') }}"><i class="fa fa-file-o fa-fw"></i>  Nueva Órden de Servicio</a>
                            </li>                            
                            @endif
                            <li {{ (Request::is('*gestor_de_ordenes_de_servicio*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('gestor_de_ordenes_de_servicio') }}"><i class="fa fa-files-o fa-fw"></i>  Gestor de Órdenes de Servicio</a>
                            </li>
                        </ul>
                    </li>
                    @if (Session::get('type') == 'administrador' || Session::get('type') == 'tesoreria')
                    <li {{ (Request::is('*tesor*') ? 'class="active"' : '') }}>
                        <a href="{{ url ('tesor') }}"><i class="fa  fa-university fa-fw"></i> Tesorería</a>
                        <ul class="nav nav-second-level">
                            <li {{ (Request::is('*tesoreria*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('tesoreria') }}"><i class="fa fa-usd fa-fw"></i>  Pagos</a>
                            </li>
                            <li {{ (Request::is('*facturas*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('facturas') }}"><i class="fa fa-file-text-o fa-fw"></i>  Facturas</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Session::get('type') == 'producción' || Session::get('type') == 'administrador')
                    <li {{ (Request::is('*produccion') ? 'class="active"' : '') }}>
                        <a href="{{ url ('produccion') }}"><i class="fa fa-video-camera"></i> Producción</a>
                        <ul class="nav nav-second-level">
                            <li {{ (Request::is('*agenda') ? 'class="active"' : '') }}>
                                <a href="{{ url ('agenda') }}"><i class="fa fa-bars"></i>  Agenda</a>
                            </li>
                            <li {{ (Request::is('*gestor_de_archivos') ? 'class="active"' : '') }}>
                                <a href="{{ url ('gestor_de_archivos') }}"><i class="fa fa-file-video-o"></i>  Gestor de Archivos</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Session::get('type') == 'desarrollador')
                    <li {{ (Request::is('*proyeccion') ? 'class="active"' : '') }}>
                        <a href="{{ url ('proyeccion') }}"><i class="fa fa-film fa-fw"></i> Proyección</a>
                        <ul class="nav nav-second-level">
                            <li {{ (Request::is('*lista') ? 'class="active"' : '') }}>
                                <a href="{{ url ('lista') }}"><i class="fa fa-film fa-fw"></i> Lista de reproducción</a>
                            </li>
                            <li {{ (Request::is('*videos') ? 'class="active"' : '') }}>
                                <a href="{{ url ('videos') }}"><i class="fa fa-file-video-o fa-fw"></i> Videos</a>
                            </li>                             
                        </ul>
                    </li>
                    @endif
                    @if (Session::get('type') == 'administrador' || Session::get('type') == 'tesoreria' || Session::get('type') == 'vendedor' || Session::get('type') == 'gerente de ventas')
                    <li {{ (Request::is('*clientes*') ? 'class="active"' : '') }}>
                        <a href="{{ url ('clientes') }}"><i class="fa fa-male fa-fw"></i> Clientes</a>
                    </li>                    
                    @endif
                    @if (Session::get('type') == 'administrador')
                    <li {{ (Request::is('*configuracion') ? 'class="active"' : '') }}>
                        <a href="{{ url ('configuracion') }}"><i class="fa fa-cog fa-fw"></i> Configuración</a>
                        <ul class="nav nav-second-level">
                            <li {{ (Request::is('*unidades_negocio*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('unidades_negocio') }}"><i class="fa fa-building-o"></i> Unidades de Negocio</a>
                            </li>
                            <li {{ (Request::is('*productos*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('productos') }}"><i class="fa fa-cube"></i> Catálogo de productos</a>
                            </li>
                            <li {{ (Request::is('*paquetes*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('paquetes') }}"><i class="fa fa-archive"></i> Paquetes de productos</a>
                            </li>
                            <li {{ (Request::is('*programas*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('programas') }}"><i class="fa fa-tv"></i> Catálogo de programas</a>
                            </li>
                            <li {{ (Request::is('*giros*') ? 'class="active"' : '') }}>
                                <a href="{{ url ('giros') }}"><i class="fa fa-briefcase"></i> Catálogo de giros</a>
                            </li>                            
                            <li {{ (Request::is('*usuarios') ? 'class="active"' : '') }}>
                                <a href="{{ url ('usuarios') }}"><i class="fa fa-user fa-fw"></i> Empleados y Usuarios</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">@yield('page_heading')</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">  
            @yield('section')

        </div>
        <!-- /#page-wrapper -->
    </div>
</div>
@stop

