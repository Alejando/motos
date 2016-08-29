<?php //-- @extends('layouts.app') }}
?>
@extends('public.base')
<!-- Main Content -->
@section('body')
<section class="container-fluid nopadding">
    <div class="login-cont">
        <div class="login-head">
            <i class="fa fa-user"></i>
            <p>Restablecer Contraseña</p>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form class="login-form {{ $errors->has('email') ? ' has-error' : '' }}" method="POST" action="{{ url('/password/email') }}">
            {{ csrf_field() }}
            <div class="form-group row">
                <div class="col-sm-12">
                    <input type="email" name="email"  value="{{old('email') }}" class="form-control2 correo" placeholder="Correo electrónico">
                </div>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn-login btn-primary">Enviar Instrucciones</button>
                </div>
            </div>
        </form>
    </div>
</section>
@stop
<?php 
/*
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

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

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
*/?>