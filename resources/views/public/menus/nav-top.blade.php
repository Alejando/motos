<div class="bienvenido">
    Hola<br><span id="nombre-usr">
        @if(Auth::check())
            {{'@'}}{{Auth::user()->name}}
        @else
        <a href="{{url('/register')}}">Registrate</a>
        @endif
    </span>
</div>
<a href="{{Auth::check() ? route('my-profile') : url('/login') }}" class="item-header text-center link-perfil" id="link-perfil" data-toggle="tooltip" title="Mi Perfil">
    <i class="fa fa-user" aria-hidden="true"></i>
</a><div class="item-header transition-0-5 text-center link-menu" id="link-menu" data-toggle="tooltip" title="Filtrar Subasta">
    <i class="fa fa-sliders" aria-hidden="true"></i>
</div> 