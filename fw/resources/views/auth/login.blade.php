@extends('public.base',[
    'showOffert'=>false,
    'showBannerBottom' => false
])
@section('body')
<?php
$email = Illuminate\Support\Facades\Input::get("email");
?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" style="margin: 100px auto;">
                <div class="panel-heading">Entrar a mi cuenta</div>
                <div class="text-center" style="margin: 10px">
                    <a href="{{route('facebook.login')}}"><img src="{{asset('img/facebook-login.png')}}" height="40"></a>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Dirección de correo</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email ? $email : old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordarme
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Iniciar sesión
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidaste tu contraseña?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
    
    
</div>









@stop