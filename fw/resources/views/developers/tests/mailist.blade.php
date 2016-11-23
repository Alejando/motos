<html>
    <head>
        <title>Correos</title>
    </head>
    <body>
        <h1>Correos:</h1>
        <ul>
            @foreach($methods as $method)
                <?php   
                    $htmlUrl = route('test.mails', [
                        'format' => 'html',
                        'type'=> $method->name
                    ]);
                    $textUrl = route('test.mails', [
                        'format' => 'txt',
                        'type' => $method->name
                    ]);
                ?>
                <li> {{$method->name}} 
                    <a href="{{$htmlUrl}}" target="_blank">html</a> |   
                    <a href="{{$textUrl}}" target="_blank">txt</a> 
                </li>
            @endforeach
        </ul>
        <div style="background-color:#F0F0F0; padding: 20px">
            <p>
                "send=1" envía al correo configurado en el archivo .dev EMAIL_TEST_DEVELOPER.
            </p>
            <p>
                "to=direcciondestino" cambia el correo de prueba. 
            </p>
        </div>
    </body>
</html>