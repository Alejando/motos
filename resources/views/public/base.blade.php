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
        <a href="#" style="display: none" id="video-glim" class="btn btn-default" 
           data-toggle="modal" 
           data-target="#videoModal" 
           data-theVideo="">VIDEO</a>
        <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <div>
                            <iframe width="100%" height="350" src="" allowfullscreen webkitallowfullscreen mozallowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('public.footer')
        @include('public.scripts')
    </body>
</html>