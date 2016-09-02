<html>
    <head>
        <meta charset="UTF-8">
        @yield('style')
    </head>
    <body>
        <div class="contenedor" style="min-width: 300px; max-width: 600px; border: 1px solid #284f53;margin: auto; text-align: center;font-family: Tahoma, Geneva, sans-serif;">
            <div class="cabeza" style="background-image: url('{{asset('img/mail/bg-head-mail.jpg')}}');background-repeat: no-repeat;">
		<img src="{{asset('img/mail/logo-glimglam.png')}}" alt="Logo Glim Glam" style="margin: 17px auto;">
            </div>
            
            @yield('message')
            
            <div class="pie" style="background-color: #343233;padding: 5px 0;height: 40px;">
                    <div style="text-align: left;display: inline-block;float: left;margin-left: 10px;margin-top: 3px;">
                            <a href="{{Config('app.social.fb')}}"><img src="{{asset('img/mail/ico-facebook.png')}}" target="_blank"></a>
                            <a href="{{Config('app.social.ig')}}"><img src="{{asset('img/mail/ico-instagram.png')}}" target="_blank"></a>
                            <a href="{{Config('app.social.yt')}}"><img src="{{asset('img/mail/ico-youtube.png')}}" target="_blank"></a>
                            <a href="{{Config('app.social.tw')}}"><img src="{{asset('img/mail/menu_twitter_34.jpg')}}" target="_blank"></a>
                    </div>
                    <div style="text-align: right;display: inline-block;float: right;margin-right: 10px;">
                            <img src="{{asset('img/mail/logo-glimglam-footer.png')}}">
                    </div>
            </div>
        </div>
    </body>
</html>   
