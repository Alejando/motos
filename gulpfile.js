var elixir = require('laravel-elixir');
require('laravel-elixir-livereload');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.sass('**/*.scss');
    mix.scripts([        
        '../../angular/admin/app.js',
        '../../angular/admin/**/*.js'
    ],'public/js/estrasol/admin.js');
    mix.scripts([
        '../../js/**/*.js',
        '../../angular/admin/public.js',
        '../../angular/admin/factories/**/*.js',
        '../../angular/admin/controllers/public/*.js'
    ], 'public/js/estrasol/public.js');
    mix.livereload();
});
