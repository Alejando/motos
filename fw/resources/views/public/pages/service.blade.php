@extends('public.base')
@section('body')
    @include('public.blocks.main-title')
    <div class="container_form_horizontal">
    	<h2 class="title_message subtitle_contact ktm_orange">Agenda tus servicios</h2>
	    <form class="form-horizontal">
	     	<div class="form-group">
		    	<label for="" class="col-sm-12 control-label" id="ktm_remove_aling">Seleccionas tu motocicleta</label>
		  	</div>
		  	<div class="form-group">
		    	<label for="" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Categoria/Año/Modelo:</label>
			    <div class="col-sm-3 ktm_margin_input">
			      	<select class="form-control" name="category" required>
					  	<option>Seleccione la categoría</option>
					  	<option>2</option>
					  	<option>3</option>
					  	<option>4</option>
					  	<option>5</option>
					</select>
			    </div>
			    <div class="col-sm-3 ktm_margin_input" name="year"   required>
			      	<select class="form-control">
					  	<option>Seleccione el año</option>
					  	<option>2</option>
					  	<option>3</option>
					  	<option>4</option>
					  	<option>5</option>
					</select>
			    </div>
			    <div class="col-sm-3 ktm_margin_input" name="model" required>
			      	<select class="form-control">
					  	<option>Seleccione un modelo</option>
					  	<option>2</option>
					  	<option>3</option>
					  	<option>4</option>
					  	<option>5</option>
					</select>
			    </div>
		 	</div>
		  	<div class="form-group">
		    	<label  class="col-sm-3 control-label"><span class="ktm_orange">*</span>Kilometraje</label>
		    	<div class="col-sm-3 ktm_margin_input">
		      		<input type="text" class="form-control" name="km" id="km" placeholder="Anote el kilometraje de su moto" required>
		    	</div>
		    	<div class="col-sm-3 ktm_margin_input">
		      		<input type="text" class="form-control" name="plates" id="plates" placeholder="Placas (Opcional)" required>
		    	</div>
		    	<div class="col-sm-3 ktm_margin_input">
		      		<input type="text" class="form-control" name="serie" id="serie" placeholder="No. de serie (Opcional)">
		    </div>
		  	</div>
		  	<div class="form-group">
		    	<label for="service" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Servicio a requerir</label>
		    	<div class="col-sm-6">
		      		<textarea class="form-control" rows="4"  name="service" placeholder="Describa la falla o servicio que requiere su motocicleta" required></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-12 control-label">Anota tus datos</label>
		  		</div>
		  	<div class="form-group">
		    	<label for="name" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Nombre completo</label>
		    	<div class="col-sm-9">
		      		<input type="text" class="form-control" name="name" id="name" placeholder="Anota tu nombre completo" required>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="phone1" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Teléfono 1</label>
		    	<div class="col-sm-3">
		      		<input type="text" class="form-control" name="phone1" id="phone1" placeholder="Anote su teléfono" required>
		    	</div>
		    	<label for="phone2" class="col-sm-3 control-label">Teléfono 2</label>
		    	<div class="col-sm-3">
		      		<input type="text" class="form-control" name="phone2" id="phone2" placeholder="Anote su teléfono">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="email" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Correo electrónico</label>
		    	<div class="col-sm-3">
		      		<input type="email" class="form-control" name="email" id="email" placeholder="Anote su correo electrónico" required>
		    	</div>
		  	</div>
		  	<div class="form-group section_btns">
		  		<button class="btn btn-default " type="reset">Limpiar campos   </button>
				<button type="submit" class="btn btn-primary btn_service">Agendar cita</button>
			</div>
		</form>
		<div class="dividing_line"></div>
		@include('public.blocks.banner-social-networks')
	</div>



@stop
