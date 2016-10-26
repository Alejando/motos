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
                        'format' => 'text',
                        'type' => $method->name
                    ]);
                ?>
                <li> {{$method->name}} 
                    <a href="{{$htmlUrl}}" target="_blank">html</a> |   
                    <a href="{{$textUrl}}" target="_blank">txt</a> 
                </li>
            @endforeach
        </ul>
    </body>
</html>