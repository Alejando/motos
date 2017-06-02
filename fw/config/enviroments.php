<?php
$env = [
//     '/var/www/html/jfcodiaz/dw.ktm-motos/fw'=> 'fco.env',
//     '/var/www/html/jfcodiaz/dw.setpoint/fw' => 'demo-host-remoto.env',
// //    '/var/www/html/jfcodiaz/dw.setpoint/fw' => '.env',
     '/home/unipi6y8/public_html/motos/fw' => 'demo.env',
//     'C:\wamp\www\dw.ktm-motos\fw' => 'gael.env',
    '/Applications/XAMPP/xamppfiles/htdocs/motos/fw' =>'alex.env'
][base_path()];
//echo __DIR__;
return $env;
