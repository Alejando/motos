<nav class="menu-principal transition-0-5">
    <ul class="listado-menu">
        <li><a class="transition-0-3" href="{{asset('acerca-de-glimglam')}}">Acerca de...</a></li>
        <li><a class="transition-0-3" href="{{asset('guía de uso')}}">Guía de uso</a></li>
        <li><a class="transition-0-3" href="{{asset('preguntas-frecuentes')}}">Preguntas frecuentes</a></li>
        <!-- <li><a class="transition-0-3" href="">Blog</a></li> -->
        <!-- <li><a class="transition-0-3" href="">Testimoniales</a></li> -->
        <li><a class="transition-0-3" href="{{asset('aviso-de-privacidad')}}">Aviso de privacidad</a></li>
        <li><a class="transition-0-3" href="{{asset('terminos-y-condiciones')}}">Terminos y Condiciones</a></li>
        @if (!Auth::guest())
            <li><a class="transition-0-3" href="{{ url('/logout') }}">Salir</a></li>
        @endif
    </ul>
</nav>