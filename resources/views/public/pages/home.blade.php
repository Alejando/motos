@extends('public.base')
@section('body')
<nav>
    <ul class="menu sub-menu-productos">
        <li><a href="">POPULARES</a></li>
        <li><a href="">DESCUENTOS</a></li>
        <li><a href="">NUEVOS</a></li>
    </ul>
</nav>

<div class="row">
    @for($i=0;$i<20;$i++)
    <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="producto">
            <div class="productohover">
                <div class="productotable">
                    <div>
                        <a href="" class="btnk"></a>
                        <h3>$000.00</h3>
                        <a href="" class="btnc"></a>
                    </div>
                </div>
            </div>
            <img src="{{asset('img/productos/'.sprintf("%03d",rand(2,6)).'.jpg')}}" class="img-responsive" />
            <h3>Zapatos Verdes Bonitos</h3>
            <h2>$000.00</h2>
        </div>
    </div>
    @endfor
</div>
@stop