
@extends('public.base')
@section('body')
    <div class="breadcrumbcustom">
        Inicio <span class="separador">-</span> <span class="current">Restablecer contraseña</span>
    </div>
<div class="cajadatos margentop30">
<div class="col-md-6 col-md-offset-3">
	@if(Session::has('message'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	    <div class="kode-alert kode-alert-icon kode-alert-click alert3">
	        <strong>{{ Session::get('message')}} </strong>
	    </div>
	</div>

    @endif

	<div class="panel panel-default">
		<div class="panel-heading">Ingresa los datos</div>
		  	<div class="panel-body">
			   	<form role="form" method="POST" action="{{ url('reset/password') }}">
			  		<div class="form-group">
			    		<label for="existingPassword">Contraseña actual</label>
			    		<input type="password" class="form-control" id="existingPassword" name="existingPassword">
			  		</div>
			  		<div class="form-group">
			    		<label for="newPassword">Nueva Contraseña</label>
			    		<input type="password" class="form-control" id="newPassword" name="newPassword">
			  		</div>
			  		<div class="form-group">
			    		<label for="passwordConfirmed">Confirmar Contraseña</label>
			    		<input type="password" class="form-control" id="passwordConfirmed" name="passwordConfirmed">
			  		</div>
			  		<div class="text-right">
			  			<button type="submit" class="btn btn-primary">Cambiar contraseña</button>
			  		</div>
				</form>
		  	</div>
		</div> 
	</div>
 </div>
@stop
