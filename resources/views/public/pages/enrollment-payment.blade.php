@extends('public.base')
@section('body')

<section class="products-container">
<h1>
    Check out Inscripcion subasta
    
    {{--dd($auction)--}}
    {{dd($user->email)}}}
</h1>
    <div>
        <a href="{{route('auciton.checkout',[
            'code' => $auction->code
        ])}}">Pagar en Paypal</a>
    </div>
</section>

@stop