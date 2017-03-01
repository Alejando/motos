@extends('public.base')
@section('body')
    @include('public.blocks.main-title')

    <section class="news">
    	<div class="news_ category">
    		<ul>CATEGORIAS:</ul>
    		@for($i=0;$i<4;$i++)
				<ul><a href="">Categoria</a></ul>
    		@endfor
    	</div>
	   	<div>
	   		
	   	</div>
    </section>

 @stop