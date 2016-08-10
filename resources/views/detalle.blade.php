@extends('public.base')
@section('body')
@foreach($subastas as $subasta)
    {!!$nombre!!} 
    <h1 class="detalle">{{$subasta->code}}</h1>
@endforeach
@stop