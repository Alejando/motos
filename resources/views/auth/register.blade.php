@extends('public.base')
@section('body')

<section class="container-fluid nopadding">

    <div class="login-cont">
        <div class="login-head">
            <div class="logo-registro">
                <img src="img/logo-glim-glam-f.png" class="img-responsive">
            </div>
            <p><span style="color: #D5A00F; font-size: 20px;">¡Cumple tu deseo!</span></p>
        </div>
        <div class="btn-facebook">
            <a href="/facebook/login/"><img src="img/facebook-login.png" alt="Iniciar sesión con facebook"></a>
        </div>
        <div class="sep-login"></div>
        <form class="login-form" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="form-group row{{ $errors->has('name') ? ' has-error' : '' }}">
                <div class="col-sm-12">
                    <input  id="name" type="text" class="form-control2" name="name" value="{{ old('name') }}" placeholder="Nombre">
                    @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="col-sm-12">
                    <input type="email" name="email" class="form-control2" placeholder="Correo electrónico" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('password') ? ' has-error' : '' }}">
                <div class="col-sm-12">
                    <input type="password" name="password" class="form-control2" placeholder="Contraseña">
                    @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <div class="col-sm-12">
                    <input type="password" name="password_confirmation" class="form-control2" placeholder="Verifica tu contraseña">
                    @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn-login btn-primary">Registrate</button>
                </div>
            </div>
            <div class="txt-registro-login">
                ¿Ya tienes una cuenta? <a href="{{url('login')}}">Inicia Sesión</a>
            </div>
        </form>
    </div>
</section>

<?php
/*
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i> Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
*/?>
@endsection

