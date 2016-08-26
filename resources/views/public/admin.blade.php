<!DOCTYPE html>
<html ng-app="glimglam">
    <head>
        <title>Glim Glam</title>
        @include('public.meta-tags')
        @include('public.stylesheets')
        @yield('head')
    </head>
    <body class="bg-body patrongg2">
        @include('public.header')
        <main>
            @yield('body')
        </main>        
        @include('public.footer')
       @yield('js-scripts')
    </body>
</html>