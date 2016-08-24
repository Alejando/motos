@extends('public.base')
@section('body')
<section class="container generic-content">
    <h2 class="content-title">@yield('content-title')</h2>
    <article class="content-body">
        @yield('body-title')
    </article>
</section>
@stop