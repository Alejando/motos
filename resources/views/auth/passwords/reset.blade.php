@extends('public.base')

@section('body')
<section class="container-fluid nopadding">
    <div class="login-cont">
        <div class="login-head">
            <i class="fa fa-user"></i>
            <p>Restablecer Contraseña</p>
        </div>
        <form class="login-form" method="POST" action="{{ url('/password/reset') }}">
             {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="text" name="email" value="{{$email or  old('email') }}" class="form-control2 correo" placeholder="Correo electrónico">                                
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
             
             
             <div class="form-group row {{$errors->has('password') ? 'has-error' : ''}}">
                <div class="col-sm-12">
                    <input type="password" name="password" value="" class="form-control2 correo" placeholder="Contraseña">
                </div>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
             
             
             <div class="form-group row{{$errors->has('password_confirmation')? ' has-error' : ''}}">
                <div class="col-sm-12">
                    <input type="password" name="password_confirmation" value="" class="form-control2 correo" placeholder="Confirmación de contraseña">
                </div>
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>
             
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn-login btn-primary">  <i class="fa fa-btn fa-refresh"></i> Restablecer Contraseña</button>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection