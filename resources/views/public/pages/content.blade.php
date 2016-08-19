@extends('public.base')

@section('body')
<section class="container generic-content">
    <h2 class="content-title">{{($objContent->name)}}</h2>
    <article class="content-text">
        {{($objContent->content)}}
    </article>
</section>
@stop