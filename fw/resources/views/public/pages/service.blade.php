@extends('public.base')
@section('body')
    @include('public.blocks.main-title')
    <div class="container_form_horizontal">
    	<h2 class="title_message subtitle_contact ktm_orange">Agenda tus servicios</h2>
	    <form class="form-horizontal">
	     	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-12 control-label" id="ktm_remove_aling">Seleccionas tu motocicleta</label>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Categoria/Año/Modelo:</label>
			    <div class="col-sm-3 ktm_margin_input">
			      	<select class="form-control" placeholder="">
					  	<option>Seleccione la categoría</option>
					  	<option>2</option>
					  	<option>3</option>
					  	<option>4</option>
					  	<option>5</option>
					</select>
			    </div>
			    <div class="col-sm-3 ktm_margin_input">
			      	<select class="form-control">
					  	<option>Seleccione el año</option>
					  	<option>2</option>
					  	<option>3</option>
					  	<option>4</option>
					  	<option>5</option>
					</select>
			    </div>
			    <div class="col-sm-3 ktm_margin_input">
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
		    	<label for="inputEmail3" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Kilometraje</label>
		    	<div class="col-sm-3 ktm_margin_input">
		      		<input type="email" class="form-control" id="inputEmail3" placeholder="Anote el kilometraje de su moto">
		    	</div>
		    	<div class="col-sm-3 ktm_margin_input">
		      		<input type="email" class="form-control" id="inputEmail3" placeholder="Placas (Opcional)">
		    	</div>
		    	<div class="col-sm-3 ktm_margin_input">
		      		<input type="email" class="form-control" id="inputEmail3" placeholder="No. de serie (Opcional)">
		    </div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Servicio a requerir</label>
		    	<div class="col-sm-6">
		      		<textarea class="form-control" rows="3" placeholder="Describa la falla o servicio que requiere su motocicleta"></textarea>
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-12 control-label">Anota tus datos</label>
		  		</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Nombre completo</label>
		    	<div class="col-sm-9">
		      		<input type="email" class="form-control" id="inputEmail3" placeholder="Anota tu nombre completo">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Teléfono 1</label>
		    	<div class="col-sm-3">
		      		<input type="email" class="form-control" id="inputEmail3" placeholder="Anote su teléfono">
		    	</div>
		    	<label for="inputEmail3" class="col-sm-3 control-label">Teléfono 2</label>
		    	<div class="col-sm-3">
		      		<input type="email" class="form-control" id="inputEmail3" placeholder="Anote su teléfono">
		    	</div>
		  	</div>
		  	<div class="form-group">
		    	<label for="inputEmail3" class="col-sm-3 control-label"><span class="ktm_orange">*</span>Correo electrónico</label>
		    	<div class="col-sm-3">
		      		<input type="email" class="form-control" id="inputEmail3" placeholder="Anote su correo electrónico">
		    	</div>
		  	</div>
		  	<div class="form-group section_btns">
		  		<div class="clean_form ktm_orange">Limpiar campos   </div>
				<button type="submit" class="btn btn-primary btn_service">Agendar cita</button>
			</div>
		</form>
		<div class="dividing_line"></div>
		@include('public.blocks.banner-social-networks')
	</div>
    
    

@stop