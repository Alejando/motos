<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultConfig extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('d_b_configs', function (Blueprint $table) {
            $table->unique('code')->change();
        });
        DB::table('d_b_configs')
                ->insert([
                        [
                        'code' => 'default-price',
                        'name' => 'Precio de envio general',
                        'value' => 129,
                        'type' => 'integer'
                    ], [
                        'code' => 'amount-for-shpping-free',
                        'name' => 'Precio minimo para envío general  gratis',
                        'value' => 2000,
                        'type' => 'integer'
                    ], [
                        'code' => 'i-v-a',
                        'name' => 'IVA',
                        'value' => 16,
                        'type' => 'integer'
                    ], [
                        'code' => 'contact-email',
                        'name' => 'Direccion de correo de contacto',
                        'value' => 'contacto@setpoint.com.mx',
                        'type' => 'string'
                    ], [
                        'code' => 'conekta-private-key',
                        'name' => 'Llave privada Conekta',
                        'value' => 'key_xLfAGPqgcBtwEy6acAvsSg',
                        'type' => 'secret'
                    ], [
                        'code' => 'conekta-public-key',
                        'name' => 'Llave Publica Conekta',
                        'value' => 'key_DzTfDkGarWq3xbyMTiAMThw',
                        'type' => 'string'
                    ], [
                        'code' => 'schedule',
                        'name' => 'Horario',
                        'value' => 'Lunes a Viernes de 9:00 a 20:00 (horario corrido)',
                        'type' => 'string'
                    ], [
                        'code' => 'address-street',
                        'name' => 'calle y numero (direccion de contacto)',
                        'value' => 'Prol. Mariano Otero 680',
                        'type' => 'string'
                    ], [
                        'code' => 'address-city',
                        'name' => 'Ciudad (direccion de contacto)',
                        'value' => 'Zapopan, Jalisco',
                        'type' => 'string'
                    ],[
                        'code' => 'address-country',
                        'name' => 'Pais (direccion de contacto)',
                        'value' => 'México',
                        'type' => 'string'
                    ],[
                        'code' => 'address-pc',
                        'name' => 'Codigo postal (direccion de contacto)',
                        'value' => '45067',
                        'type' => 'string'
                    ],[
                        'code' => 'tel-contact',
                        'name' => 'Telefono (direccion de contacto)',
                        'value' => '(33) 3336 7487 ',
                        'type' => 'string'
                    ], [
                        'code' => 'url-facebook',
                        'name' => 'Facbook URL',
                        'value' => 'https://www.facebook.com/bouncetennis/',
                        'type' => 'url'
                    ], [
                        'code' => 'url-twitter',
                        'name' => 'Twitter URL',
                        'value' => 'https://twitter.com/bouncetennis/',
                        'type' => 'url'
                    ], [
                        'code' => 'url-instragram',
                        'name' => 'Instragram URL',
                        'value' => 'https://www.instagram.com/bouncetennis/',
                        'type' => 'url'
                    ], [
                        'code' => 'url-youtube',
                        'name' => 'Youtube URL',
                        'value' => 'https://www.youtube.com/channel/bouncetennis/',
                        'type' => 'url'
                    ], [
                        'code' => 'fb-client-id',
                        'name' => 'Cliente Id de Fb',
                        'value' => env('FB_CLIENT_ID'),
                        'type' => 'strng'
                    ], [
                        'code' => 'fb-client-secret',
                        'name' => 'Cliente secreto de Fb',
                        'value' => env('FB_CLIENT_SECRET'),
                        'type' => 'secret'
                    ], /*[
                        'code' => 'fb-redirect',
                        'name' => 'FB url de redireccion',
                        'value' => env('APP_URL') . env("FB_CALLBACK"),
                        'type' => 'url'
                    ],*/ [
                        'code' => 'paypal-client-id',
                        'name' => 'Paypal client id ',
                        'value' => 'AR3RufCk6OU44nrbGF2nDIvOxRYjpzYvWyAxAFRedJrL6eSzay9jLyqTTr2xZNgfGtzUg3j2BehjuvyI',
                        'type' => 'secret'
                    ], [
                        'code' => 'paypal-secret',
                        'name' => 'Paypal Secret',
                        'value' => 'EPUBTP0rB7NsvsZluLmcsreaGP1z7bj9cKhUkDSiRgxkc4lH5tDDhCRM-8l9sqqTEigkTJQtn8mKfDqI',
                        'type' => 'secret'
                    ], [
                        'code' => 'lat-lon-contact',
                        'name' => 'Ubicación de contacto',
                        'value' => '20.6713684,-103.3642475',
                        'type' => 'latlon'
                    ], [
                        'code' => 'couta-oxxo',
                        'name' => 'Couta de pagos en oxxo',
                        'value' => 8,
                        'type' => 'integer'
                    ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        DB::table('d_b_configs')->truncate();
        Schema::table('d_b_configs', function (Blueprint $table) {
            $table->dropUnique('d_b_configs_code_unique');
        });
        
    }
    

}
