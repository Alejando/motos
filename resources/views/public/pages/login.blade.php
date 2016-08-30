@extends('public.base')
@section('body')

<section class="container-fluid nopadding">
    <div class="login-cont">
        <div class="login-head">
            <i class="fa fa-user"></i>
            <p>Iniciar Sesión</p>
        </div>
        <div class="btn-facebook"> 
            <a href="{{route('facebook.login')}}"><img src="img/facebook-login.png" alt="Iniciar sesión con facebook"></a>
        </div>
        <div class="sep-login"></div>
        <form class="login-form" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control2 correo" placeholder="Correo electrónico">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="password" name="password" class="form-control2" placeholder="Contraseña">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            
            
            <div class="form-group ">
                <div class="col-md-12 ">
                    <div class="checkbox ">
                        <label class="txt-registro-login remeber-me">
                            <input type="checkbox" name="remember"> No cerrar sesión
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn-login btn-primary">Entrar</button>
                </div>
            </div>
            <div class="txt-registro-login">
                ¿Aún no tienes una cuenta? <a href="{{url('register')}}">Regístrate aquí</a>
            </div>
            <div class="txt-registro-login txt-registro-login">
                <a href="{{ url('/password/reset') }}">¿Has olvidado la contraseña?</a>
            </div>
        </form>
    </div>
</section>
@stop()