<?php
$imgZoom = route('product.img',[
            'id' => $product,
            'width' => 1000,
            'height' => 1000,
            'img'=>$img
        ]);
?>
<html>
    <head>
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
            #close{
                z-index: 100;
                font-size: 100px;
                font-family: arial;
                color: gray;
                position:absolute;
                top: 20px;
                left: 20px;
                padding: 100px;
                font-weight: 700;
                opacity: .7;
                padding: 100px;
            }
        </style>
    </head>
    <body>
        <div class="close heavy" id="close">x</div>
        <div class="img">
            <img src="{{$imgZoom}}">
        </div>
        <script src="{{asset('/js/bower_components/jquery/dist/jquery.min.js')}}" type="text/javascript"></script>
        <script>
            
            $('#close').click(function(){
                window.close();
            });

        </script>
    </body>
</html>