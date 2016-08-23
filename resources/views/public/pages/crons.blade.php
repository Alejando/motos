@extends('public.base')
@section('body')
<div>
    <h1> Test Crons </h1>
    <pre class="crons">

    </pre>
</div>
@stop
@section('js-scripts')
<script type='text/javascript' src="{{asset('js/estrasol/test-cron.js')}}"></script>
@stop