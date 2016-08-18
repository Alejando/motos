@extends('public.base')
@section('body')

<section class="products-container">
<h1>
    Check out Inscripcion subasta
</h1>
    <div>
        <a href="{{route('auciton.checkout',[
            'code' => $code
        ])}}">Pagar en Paypal</a>
    </div>
</section>

@stop