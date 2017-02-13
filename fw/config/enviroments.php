<?php
$env = [
//    '/var/www/html/jfcodiaz/dw.setpoint/fw' => 'demo-host-remoto.env',
    '/var/www/html/jfcodiaz/dw.setpoint/fw' => '.env',
    '/home/demoemx/public_html/setpoint/fw' => 'demo.env',
    'C:\wamp\www\dw.setpoint\fw' => 'gael.env'
][base_path()];  
return $env;
