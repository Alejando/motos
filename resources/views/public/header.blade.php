@include('public.blocks.fancy-login')
<header class="container-fluid main-header">
    <section class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <a href="{{asset('')}}">
                <img src="img/logo.png" alt="Glim Glam" title="Glim Glam &reg;" class="logo">
            </a>
        </div>

        <div class="header-menu col-lg-4 col-lg-offset-5 col-md-4 col-md-offset-5 col-sm-6 col-sm-offset-2 col-xs-6 text-right">
            @if(trim($__env->yieldContent('nav-top')))
                @yield('nav-top')
            @else
                @include('public.menus.nav-top')
            @endif
        </div>
    </section>
    @include('public.menus.nav-rigth')
</header>
<div class="subir transition-0-5">
    <i class="fa fa-chevron-up" aria-hidden="true"></i>
</div>