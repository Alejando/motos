<nav class="menu-lateral menu-principal transition-0-5">
    <ul class="listado-menu">
        @if (!Auth::guest())
            <li><a class="transition-0-3" href="{{asset('acerca-de-glimglam')}}">Mi perfil</a></li>
            <li><a class="transition-0-3" href="{{ url('/logout') }}">Salir</a></li>
        @elseif
            <li><a class="transition-0-3" href="{{asset('acerca-de-glimglam')}}">Iniciar sesión</a></li>
            <li><a class="transition-0-3" href="{{ url('/logout') }}">Registrarse</a></li>
        @endif
    </ul>
</nav>