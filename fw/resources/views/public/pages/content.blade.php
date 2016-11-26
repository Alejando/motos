@extends('public.base')
@section('body')
<nav>
<div class="row col-md-12 col-sm-12">
	<br>
	<h2 class="titulo text-center">{{$content->title}}</h2>
    <blockquote class="text-justify">{!!$content->content!!}</blockquote>
</div>
</nav>

@stop