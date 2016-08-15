<html>
    <head>
        <meta charset="UTF-8">
        @yield('style')
    </head>
    <body>
        <div class="contenedor" style="min-width: 300px; max-width: 600px; border: 1px solid #284f53;margin: auto; text-align: center;font-family: Tahoma, Geneva, sans-serif;">
            <div class="cabeza" style="background-image: url('{{asset('img/mail/bg-head-mail.jpg')}}');background-repeat: no-repeat;">
		<img src="{{$message->embed('img/mail/logo-glimglam.png')}}" alt="Logo Glim Glam" style="margin: 17px auto;">
	</div>
	<div class="banner" style="background-image:  url('{{asset('img/mail/bg-banner-mail.jpg')}}');padding: 18px 0;">
		<div style="width: 90px; height: 90px; background-color: #fff; border: 2px solid #866509;margin: auto;border-radius: 10px;">
			<img src="{{$message->embed('img/mail/producto-mail.png')}}">
		</div>
		<h2 style="color: #d5a00f; text-transform: uppercase; margin: 5px auto;font-weight: 100;">RELOJ CUAUHTEMOC</h2>
		<p style="color: #fff; margin: 2px;text-transform: uppercase;">SUBASTA #<span>7648</span></p>
	</div>
                @yield('message')
        </div>
    </body>
</html>   