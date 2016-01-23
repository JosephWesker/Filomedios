@extends ('layouts.plane')
@section ('body')
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/login/login.css") }}" />
        <link rel="stylesheet" href="{{ asset("assets/stylesheets/login/style.css") }}" />


    <div class="middle-box text-center loginscreen animated fadeInDown">
            <div id="logo-filomedios"></div>
<!--            <div id="logo-bim"></div>-->

            <form class="m-t" role="form" id="login">
                <div class="form-group">
                    <input required class="form-control" placeholder="E-mail" name="email" type="email" id="email" autofocus >
                </div>
                <div class="form-group">
                    <input required class="form-control" placeholder="Contraseña" name="password" type="password" id="password" value="" >
                </div>
                {{ Form::submit('Iniciar sesión',['class' => 'btn btn-primary block full-width m-b','onclick' => 'login();return false;']) }}
            </form>
            <div id="form_message" style="height: 40px; width: 100%;"></div>
    </div>
            <div id="logo-filcoc" class="img-responsive"></div>
            <div id="logo-connect" class="img-responsive"></div>

    <script>
        var loginRoute = '{{ action('loginController@postLogon'); }}';
        var homeRoute = '{{ route('home'); }}';
    </script>
    <script src="{{ asset("assets/scripts/login_ajax.js") }}" type="text/javascript"></script>
@stop