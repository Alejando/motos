
        {{-- SCRIPTS --}}
        <script>var ivaCant = {{config('app.iva')}};</script>
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
        <script type="text/javascript" src="{{asset('js/thirdparty/angular-rangeslider/angular.rangeSlider.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/humanize-duration/humanize-duration.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/angular-timer/dist/angular-timer.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/bower_components/moment/min/moment-with-locales.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/estrasol/public.js')}}"></script>
        @yield('js-scripts')
        