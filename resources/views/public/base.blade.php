<!DOCTYPE html>
<html ng-app="glimglam">
    <head>
        <title>Glim Glam</title>
        @include('public.meta-tags')
        @include('public.stylesheets')
        @yield('head')
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '488925211317397');
            fbq('track', "PageView");
        </script>
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