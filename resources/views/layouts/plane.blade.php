<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <head>
        <meta charset="utf-8"/>
        <title>Filomedios</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
         <!-- Bootstrap Calendar CSS -->
        <!--                <link href="{{ asset("assets/scripts/bootstrap-calendar/bootstrap.css") }}" rel="stylesheet">-->
        <link href="{{ asset("assets/scripts/bootstrap-calendar/bootstrap-responsive.css") }}" rel="stylesheet">
        <link href="{{ asset("assets/scripts/bootstrap-calendar/css/calendar.css") }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/custom.css") }}" />
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/form-wizard.css") }}" />
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/jquery.steps.css") }}" />
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/selectTable.css") }}" />
        <link rel="stylesheet" href="{{ asset("assets/scripts/tabs-products/jquery-ui.css") }}" />
        <link rel="stylesheet" href="{{ asset("assets/scripts/tabs-products/tabs-products.css") }}" />
        <!-- Bootstrap Calendar CSS -->
        <link rel="stylesheet" href="{{ asset("assets/scripts/bootstrap-table-master/dist/bootstrap-table.css") }}" />
    </head>
    <body>
        @yield('body')
        <script src="{{ asset("assets/scripts/frontend.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/wizard/jquery.steps.min.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/wizard/form-wizard.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/add.remove.elements.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/sortable/jquery.sortable.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/sortable/sortable-table.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/tabs-products/jquery-ui.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/tabs-products/tabs-products.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/add.date.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/radiobuttons.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/selectProducts.js") }}" type="text/javascript"></script>
         <!-- Bootstrap Calendar JS -->
        <script src="{{ asset("assets/scripts/bootstrap-calendar/js/language/es-MX.js") }}" type="text/javascript"></script>
<!--        <script src="{{ asset("assets/scripts/bootstrap-calendar/jquery.min.js") }}" type="text/javascript"></script>-->
        <script src="{{ asset("assets/scripts/bootstrap-calendar/underscore-min.js") }}" type="text/javascript"></script>
<!--        <script src="{{ asset("assets/scripts/bootstrap-calendar/bootstrap.min.js") }}" type="text/javascript"></script>-->
        <script src="{{ asset("assets/scripts/bootstrap-calendar/js/calendar.js") }}" type="text/javascript"></script>
        <!--<script src="{{ asset("assets/scripts/bootstrap-calendar/js/app.js") }}" type="text/javascript"></script>-->
        <!-- Bootstrap Table JS -->
        <script src="{{ asset("assets/scripts/bootstrap-table-master/dist/bootstrap-table.js") }}" type="text/javascript"></script>
        <script src="{{ asset("assets/scripts/bootstrap-table-master/src/locale/bootstrap-table-es-MX.js") }}" type="text/javascript"></script>
    </body>
</html>