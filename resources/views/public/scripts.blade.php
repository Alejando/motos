
        {{-- SCRIPTS --}}
        <script>var ivaCant = {{config('app.iva')}};</script>
        <div id="fb-root"></div>
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '488925211317397');
            fbq('track', "PageView");
            //Lucky orange
            window.__lo_site_id = 63979;
            (function() {
                    var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
                    wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
            })();
        </script>
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
