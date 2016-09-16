@extends('admin.base')
@section('body')
    <div ng-view></div>
@stop
@section('scripts')
    <script src="{{asset('/js/estrasol/app.js')}}" type="text/javascript"></script> 
@stop