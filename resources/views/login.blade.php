@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Please Sign In')
               @section ('login_panel_body')
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" id="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" id="password" value="">
                                </div>                               
                                <!-- Change this to a button or input when using this as a form -->
                                {{ Form::button('Aceptar',['class' => 'btn btn-success','onclick' => 'login()']) }}
                            </fieldset>
                        </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
    <script>
        var loginRoute = '{{ action('loginController@postLogon'); }}';
        var homeRoute = '{{ route('home'); }}';
    </script>
    <script src="{{ asset("assets/scripts/login_ajax.js") }}" type="text/javascript"></script>
@stop