@extends('layouts.plane')

@section('body')
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
            <a class="navbar-brand" href="{{ url ('') }}">Filomedios</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
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
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
            
            <!-- /.dropdown -->
            <li class="dropdown">
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
                <!-- /.dropdown-alerts -->
            </li>
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Configuración</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="{{ url ('login') }}"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
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
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                        <a href="{{ url ('') }}"><i class="fa fa-dashboard fa-fw"></i> Panel Principal</a>
                    </li>
                    <li >
                        <a href="#"><i class="fa fa-list-alt fa-fw"></i> Negocios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li {{ (Request::is('*negocios') ? 'class="active"' : '') }}>
                                <a href="{{ url ('negocios') }}">Negocios</a>
                            </li>
                            <li {{ (Request::is('*prospectos') ? 'class="active"' : '') }}>
                                <a href="{{ url ('prospectos' ) }}">Prospectos</a>
                            </li>
                            <li {{ (Request::is('*clientes') ? 'class="active"' : '') }}>
                                <a href="{{ url('clientes') }}">Clientes</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li {{ (Request::is('*ordenes_de_servicio') ? 'class="active"' : '') }}>
                        <a href="{{ url ('ordenes_de_servicio') }}"><i class="fa fa-files-o fa-fw"></i> Órdenes de Servicio</a>
                    </li>
                    <li {{ (Request::is('*pagos') ? 'class="active"' : '') }}>
                        <a href="{{ url ('pagos') }}"><i class="fa fa-usd fa-fw"></i> Pagos</a>
                    </li>
                    <li {{ (Request::is('*proyeccion') ? 'class="active"' : '') }}>
                        <a href="{{ url ('proyeccion') }}"><i class="fa fa-edit fa-fw"></i> Proyección</a>
                    </li>
                    <li {{ (Request::is('*reportes') ? 'class="active"' : '') }}>
                        <a href="{{ url ('reportes') }}"><i class="fa fa-edit fa-fw"></i> Reportes</a>
                    </li>
                    <li {{ (Request::is('*Empleados') ? 'class="active"' : '') }}>
                        <a href="{{ url ('empleados') }}"><i class="fa fa-user fa-fw"></i> Empleados</a>
                    </li>
                    <li {{ (Request::is('*usuarios') ? 'class="active"' : '') }}>
                        <a href="{{ url ('usuarios') }}"><i class="fa fa-user fa-fw"></i> Usuarios</a>
                    </li>

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

