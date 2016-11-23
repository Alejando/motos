@extends('mails.frames.common-txt')

@section('message')
    {{$user->name}}
    {{$user->email}}
@stop 