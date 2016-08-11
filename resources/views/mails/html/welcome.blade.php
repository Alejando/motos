@extends('mails.frames.common')

@section('style')
<style>
    .welcome {
        color:blue;
    }
</style>
@stop

@section('message')

Welcome! <span class="welcome">s{{$user->name}}</span>
    {{$user->email}}
    {{env('EMAIL_TEST_DEVELOPER')}}
    <img src="{{$message->embed("img/logo.png")}}">
@stop   