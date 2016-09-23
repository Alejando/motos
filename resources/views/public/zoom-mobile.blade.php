<?php
$auction = \GlimGlam\Models\Auction::getByCode($code);
$img = route('auction.getImg',[
            'version' => 'zoom',
            'code' => $code,
            'photos' => $img
        ]);
?><html>
    <head>
        <title>Zoom Imagen, Subasta {{$auction->title}}</title>
        <style>
            html,body{
                height: 100%;
                width: 100%;
                margin: 0px;
                padding: 0px;
            }
            .img{
                background-color: white;
                width: 100%;
                height: 100%;
                display: block;
            }
            .img img{
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="img">
            <img src="{{$img}}" >
        </div>
        <script src="{{asset('js/bower_components/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script>
            $('body').click(function(){
                window.close();
            });
        </script>
    </body>
</html>