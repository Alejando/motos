@extends('mails.frames.common')

@section('style')
<style>
    .welcome {
        color:blue;
    }
</style>
@stop

@section('message')

Welcome! <span class="welcome">{{$user->name}}</span>
    {{$user->email}}

@stop