<footer>
	<div class="separator_line"></div>
	<div class="section group section_main">
		<div class="col footer_section ktm_visibility">
			<ul >
				<li><a href="" class="ktm_orange">Motos</a></li>
				@foreach(\DwSetpoint\Models\Category::getChildrenBySlug('motos') as $key=>$subcategory)
					<li><a href="{{url('/motos/'.$subcategory->name)}}" class="ktm_white">{{$subcategory->name}}</a></li>
				@endforeach
			</ul>
		</div>
		<div class="col footer_section ktm_visibility">
			<ul>
				<li><a href="" class="ktm_orange">Boutique</a></li>
				@foreach(\DwSetpoint\Models\Category::getChildrenBySlug('boutique') as $key=>$subcategory)
					<li><a href="{{url('/motos/'.$subcategory->name)}}" class="ktm_white">{{$subcategory->name}}</a></li>
				@endforeach
			</ul>
		</div>
		<div class="col footer_section ktm_visibility">
			<ul>
				<li><a  class="ktm_orange">Servicio</a></li>
				<li><a href="{{url('/servicio')}}" class="ktm_white">Agenda cita</a></li>
			</ul>
		</div>
		<div class="col footer_section ktm_visibility">
			<ul>
				<li><a href="" class="ktm_orange">Mas</a></li>
				<li><a href="" class="ktm_white">Noticias Populares</a></li>
				<li><a href="" class="ktm_white">Últimas noticias</a></li>
				<li><a href="{{url('/aviso-de-privacidad')}}" class="ktm_white">Aviso de privacidad</a></li>
			</ul>
		</div>
		<div class="col footer_section col_5">
			<div class="col section_contact">
				<ul>
					<li class="ktm_orange">Contacto</li>
					<li class="ktm_white" id="address">Av. Patria #5435 Col. Patria Country CP. 54234 Zapopan, Jalisco</li>
					<li class="ktm_white" id="phone">(45) 35324 45345</li>
					<li class="ktm_white" id="email">conact@eusero.mx</li>
				</ul>
			</div>
			<div class="col section_newsletter">
				<div class="ktm_orange">Suscribete a nuestro newsletter</div>
				<form>
					<div class="input-group">
						<input type="text" name="correo" class="form-control form_newletter">
						<span class="input-group-btn">
							<input type="submit" value="Suscribirme" class="btn btn-primary form_newletter">
						</span>
					</div>
				</form>
			</div>


		</div>
	</div>
	<div class="section group belt_footer">
		<div class="col span_1_of_2">

				<div class="icons_social">
					<figure class="icon_social">
						<img src="{{asset('img/bikes_facebook.svg')}}">
					</figure>
					<figure class="icon_social">
						<img src="{{asset('img/bikes_twitter.svg')}}">
					</figure>
					<figure class="icon_social">
						<img src="{{asset('img/bikes_google.svg')}}">
					</figure>
					<figure class="icon_social">
						<img src="{{asset('img/bikes_instagram.svg')}}">
					</figure>
					<figure class="icon_social">
						<img src="{{asset('img/bikes_pinterest.svg')}}">
					</figure>
				</div>


		</div>
		<div class="col span_1_of_2">
			<div class="text_copy_right ktm_white">Todos los derechos reservados | <b>KTM Motos</b></div>
		</div>
	</div>
</footer>
