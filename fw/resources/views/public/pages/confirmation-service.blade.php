@extends('public.base')
@section('body')
    @include('public.blocks.main-title')
    <div class="container_form_horizontal">
    	<h2 class="title_message subtitle_contact ktm_orange">Servicio agendado</h2>
    	<div class="text_response">
    		<p>Tu servicio ha sido correctamente enviado, <span class="ktm_orange">en breve uno de nuestros especialistas se contactará con usted para confirmar la fecha y hora de tu cita. Cualquier duda o comentario respecto a tu servicio comunicate con nosotros a los:</span></p>
    		<p>Telefonos
    		<span class="ktm_orange ">+52 (33) 3332-3130 o (33) 3329-2827</span></p>
    		<p>Correo electrónico:
    		<span class="ktm_orange ">contacto@eurobike.mx</span></p>
    		<span class="ktm_orange ">KTM Guadalajara agradece tu preferencia.</span>
    	</div>
    	<div class="form-group section_btns">
    		<button type="submit" class="btn btn-primary btn_service">Regresar al inicio</button>
		</div>
		<div class="dividing_line"></div>
		@include('public.blocks.banner-social-networks')
	</div>
@stop