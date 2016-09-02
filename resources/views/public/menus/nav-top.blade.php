<div class="bienvenido">
    Hola <br><span id="nombre-usr">
        @if(Auth::check())
            {{'@'}}{{Auth::user()->name}}
        @else
            <a href="{{url('/register')}}">¡Regístrate!</a>
        @endif
    </span>
</div>
<a href="{{Auth::check() ? route('my-profile') : url('/login') }}" class="item-header text-center link-perfil col-xs-4" id="link-perfil" data-toggle="tooltip" title="Mi Perfil">
    <i class="fa fa-user" aria-hidden="true"></i>
</a>{{--<div class="item-header transition-0-5 text-center link-menu col-xs-4" id="link-search" data-toggle="tooltip" title="Buscar subasta">
    <i class="fa fa-search" aria-hidden="true"></i>
</div>--}}<div class="item-header transition-0-5 text-center link-menu col-xs-4" id="link-menu" data-toggle="tooltip" title="Menu">
    <i class="fa fa-sliders" aria-hidden="true"></i>
</div>