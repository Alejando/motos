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
elixir.config.assetsDir = '../'; //trailing slash required.
elixir(function(mix) {
    // mix.sass([
    //     'admin/*.scss',
    //     'admin/**/*.scss'
    // ],'../css/app.css');
    mix.sass([
        'web/*.scss',
        'web/**/*.scss'
    ], '../css/web.css');


    mix.scripts([
        '../../angular/contexts/admin/app.js',
        '../../angular/contexts/admin/app-config.js',
        '../../angular/common/*.js',
        '../../angular/common/**/*.js',
        '../../angular/contexts/admin/controllers/*.js'
    ], '../js/estrasol/app.js');
    mix.scripts([
        '../../angular/contexts/web/app.js',
        '../../angular/common/*.js',
        '../../angular/common/**/*.js',
        '../../angular/contexts/web/controllers/*.js'
    ], '../js/estrasol/web-angular.js');
    mix.livereload();
});
