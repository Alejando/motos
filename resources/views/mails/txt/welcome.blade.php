@extends('mails.frames.common-txt')
@section('message')
    Welcome! {{$user->name}}
@stop 