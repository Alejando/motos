"BOUNCE"
Tennis Lifestyle



@yield('message')

    Horario de atención: {{Config('app.schedule')}}
    Aviso de privacidad: {{route('Content.slug',['slug'=>'aviso-de-privacidad'])}}
    
        - Twitter: {{Config('app.social.twitter')}}
        - Facebook: {{Config('app.social.facebook')}}
        - Youtube: {{Config('app.social.youtube')}}
        - Instagram: {{Config('app.social.instagram')}}