@extends('public.pages.base-contents')
@section('content-title')
    {{($objContent->name)}}
@stop
@section('body-title')
    {{($objContent->content)}}
@stop