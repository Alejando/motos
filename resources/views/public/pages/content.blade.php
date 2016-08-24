@extends('public.pages.base-contents')
@section('content-title')
    {!!($objContent->name)!!}
@stop
@section('content-body')
    {!!$objContent->content!!}
@stop