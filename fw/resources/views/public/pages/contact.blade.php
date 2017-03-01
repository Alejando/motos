@extends('public.base')
@section('body')
    @include('public.blocks.main-title')
    <div class="contact_container">
    	<div class="main_container">
		   	<div class="section group info_contact">
				<div class="col  section_visit">
					<ul>
						<li class="ktm_orange subtitle_contact">Visítanos</li>
						<li class="ktm_gray_dark" id="address">Av. Patria #5435 Col. Patria Country CP. 54234 Zapopan, Jalisco</li>
						<li class="ktm_gray_dark" id="phone">(45) 35324 45345</li>
						<li class="ktm_gray_dark" id="email">conact@eusero.mx</li>
					</ul>
				</div>
				<div class="col  section_follow">
					<h2 class="ktm_orange subtitle_contact">Siguenos</h2>
					<figure class="social_figure">
						<img src="{{asset('img/bikes_facebook.svg')}}"> Facebook
					</figure>
					<figure class="social_figure">
						<img src="{{asset('img/bikes_twitter.svg')}}"> Twitter
					</figure>
					<figure class="social_figure">
						<img src="{{asset('img/bikes_google.svg')}}"> Google +
					</figure>
					<figure class="social_figure">
						<img src="{{asset('img/bikes_instagram.svg')}}"> Instagram
					</figure>
					<figure class="social_figure">
						<img src="{{asset('img/bikes_pinterest.svg')}}"> Pinterest
					</figure>	
				</div>
		   	</div>
		   	<div class="dividing_line"></div>
		   	<div class="form_contact">
		   		<h2 class="title_message subtitle_contact ktm_orange">Envíanos un mensaje</h2>
		   		<form>
		   			<div class="form-group row_3">
				    	<label for="exampleInputEmail1">Correo electrónico:</label>
				    	<input type="email" class="form-control">
				  	</div>
				  	<div class="form-group row_3">
				    	<label for="exampleInputEmail1">Nombre:</label>
				    	<input type="text" class="form-control">
				  	</div>
				  	<div class="form-group row_3">
				    	<label for="exampleInputEmail1">Teléfono:</label>
				    	<input type="text" class="form-control">
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputEmail1">Asunto:</label>
				    	<input type="text" class="form-control">
				  	</div>
				  	<div class="form-group">
				    	<label for="exampleInputEmail1">Mensaje:</label>
				    	<textarea class="form-control" rows="3"></textarea>
				  	</div>
				  	<div class="clean_form">Limpiar campos</div>
				  	<button type="submit" class="btn btn-primary btn_contact">Enviar mensaje</button>
		   		</form>
		   	</div>
		</div>
	   	<div class="map_contact">
	   		<h3 class="subtitle_contact ktm_orange map_mge">Estamos a tus órdenes en:</h3>
	   		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8876.758926531906!2d-103.40690507502644!3d20.70139554803956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xee86b7bd74920eeb!2sCentro+Comercial+Andares!5e0!3m2!1ses-419!2smx!4v1488214701529" width="100%" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
	   	</div>
   	</div>
@stop