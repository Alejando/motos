<!DOCTYPE html>
<html>
    <head>
        <title>Bounce :: Tennis Lifestyle</title>
        @include('admin.metas')
        @include('admin.style-sheets')
    </head>
    <body class="fixed-left" ng-app="setpoint" ng-controller="MainCtrl">
        <div id="wrapper">
            @include('admin.header')
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        @yield('body')
                    </div> <!-- container -->

                </div> <!-- content -->
                @include('admin.footer')
            </div>
            @include('admin.menu-derecha')
        </div>
        @include('admin.scripts')
    </body>
</html>