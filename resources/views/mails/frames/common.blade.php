<html>
    <head>
        <style>
            .divSup {
                border: 1px solid black;padding: 50px;
                color:red;
                font-size:50px;
            }
        </style>
        @yield('style')
    </head>
    <body>
        <div class="divSup">
            Frame Común
            <div style="border: 1px solid black;padding: 50px;">
                @yield('message')
            </div>
        </div>

    </body>
</html>   