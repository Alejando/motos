
        {{-- SCRIPTS --}}
        <script>var ivaCant = {{config('app.iva')}};</script>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId={{ config('app.fb_IdApp' )}}";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{asset('js/thirdparty/zoom/jquery.elevatezoom.js')}}"></script>
        {{-- jQuery REVOLUTION Slider  --}}
        <script type="text/javascript" src="{{asset('js/thirdparty/rs-plugin/js/jquery.themepunch.plugins.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/thirdparty/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/estrasol/frontend.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/laroute.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/angular/angular.min.js')}}"></script>
        {{-- RangeSlider --}}
        <script type="text/javascript" src="{{asset('js/bower_components/bootbox.js/bootbox.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/thirdparty/angular-rangeslider/angular.rangeSlider.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/humanize-duration/humanize-duration.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/angular-timer/dist/angular-timer.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/moment/min/moment-with-locales.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/angular-slugify/angular-slugify.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/estrasol/public.js')}}"></script>
        @yield('js-scripts')
        <!--Start of Zopim Live Chat Script-->
        <script type="text/javascript">
        window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
        d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
        _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
        $.src="//v2.zopim.com/?4BoKyUSD7oGSS1sgh4tg4kcXDLylGS5w";z.t=+new Date;$.
        type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
        </script>
        <!--End of Zopim Live Chat Script-->
