<html>
    <head>
        <meta charset="UTF-8">
        <style>
            .header {
                min-width: 300px; 
                max-width: 600px; 
                margin: auto; 
                text-align: 
                center;font-family: Tahoma, Geneva, sans-serif; 
                background: #f9f9f9;
            }
            .logo_header{
                padding: 2%; 
                text-align: left; 
                background: #FFF; 
                box-shadow: 0 1px 3px #ddd;
            }
            .footer{
                background: #002B53; 
                padding: 10px;
            }
            .schedule_footer{
                width: 49%; text-align: 
                left; display: inline-block; 
                vertical-align: top; color: #FFF;
            }
            .hours{
                display: block; 
                padding: 10px 0 0 0;
            }
            .link_notice{
                font-size: 12px; 
                color: #FFF; 
                text-decoration: none;
            }
            .social_media{
                width: 49%; 
                text-align: right; 
                display: inline-block; 
                vertical-align: top;
            }
            @yield('style')
        </style>
    </head>
    <body>
        <body>
        <!--HEADER inicio-->
            <div class="header">
                <div class="logo_header">
                    <img src="{{asset('img/mail/logo.png')}}" />
                </div>
        <!--HEADER fin-->

        <!--BODY inicio-->
            @yield('message')
        <!--BODY fin-->

        <!--FOOTER inicio-->
                    <div class="footer">
                        <div class="schedule_footer">
                            <span class="hours">
                                Horario de atención: 00:00 a 00:00<br />
                                <a href="" class="link_notice">Aviso de privacidad</a>
                            </span>
                        </div>
                        <div class="social_media">
                            <a href=""><img src="{{asset('img/mail/01icono.jpg')}}" /></a>
                            <a href=""><img src="{{asset('img/mail/02icono.jpg')}}" /></a>
                            <a href=""><img src="{{asset('img/mail/03icono.jpg')}}" /></a>
                            <a href=""><img src="{{asset('img/mail/04icono.jpg')}}" /></a>
                        </div>
                    </div>
                </div>
            </div>
        <!--FOOTER fin-->
    </body>
</html>   
