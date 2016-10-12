        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{asset('assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('assets/js/detect.js')}}"></script>
        <script src="{{asset('assets/js/fastclick.js')}}"></script>

        <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
        <script src="{{asset('assets/js/waves.js')}}"></script>
        <script src="{{asset('assets/js/wow.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

        <script src="{{asset('assets/plugins/peity/jquery.peity.min.js')}}"></script>
        <!-- jQuery  -->
        <script src="{{asset('assets/plugins/waypoints/lib/jquery.waypoints.js')}}"></script>
        <script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

        

        <!-- Knob -->
        <script src="{{asset('assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
        <script src="{{asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')}}"></script>
        
        
        <script src="{{asset('assets/js/jquery.core.js')}}"></script>
        <script src="{{asset('assets/js/jquery.app.js')}}"></script>

        <script src="{{asset('js/bower_components/datatables.net/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular/angular.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-route/angular-route.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-datatables/dist/angular-datatables.min.js')}}"></script>

        <script src="{{asset('/js/bower_components/tinymce/tinymce.js')}}" type="text/javascript"></script>
        <script src="{{asset('/js/bower_components/angular-ui-tinymce/src/tinymce.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('js/laroute.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-datatables/dist/plugins/bootstrap/angular-datatables.bootstrap.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/bootstrap3-dialog/src/js/bootstrap-dialog.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/tinycolor/dist/tinycolor-min.js')}}" type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-color-picker/dist/angularjs-color-picker.min.js')}}" type="text/javascript"></script>
        
        <script src="{{asset('js/bower_components/jstree/dist/jstree.min.js')}}"  type="text/javascript"></script>
        <script src="{{asset('js/bower_components/jsTree-directive/jsTree.directive.js')}}"  type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-ui-select/dist/select.min.js')}}"  type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-sanitize/angular-sanitize.js')}}"  type="text/javascript"></script>
        <script src="{{asset('js/bower_components/angular-slugify/angular-slugify.js')}}"  type="text/javascript"></script>
        @yield('scripts')
        
        <script type="text/javascript">
            jQuery(document).ready(function($) {
              
                $(".knob").knob();

            });
        </script>
