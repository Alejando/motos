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
    mix.sass([
        'admin/*.scss',
        'admin/**/*.scss'
    ],'public/css/app.css');
    mix.sass([
        'web/*.scss',
        'web/**/*.scss'
    ], 'public/css/web2.css');
//    mix.copy('resources/assets/sass/sprites.png', 'public/css/sprites.png');
//    mix.less('ubold-template/components.less','public/assets/css/components.css');
//    mix.less('ubold-template/core.less','public/assets/css/core.css');
//    mix.less('ubold-template/elements.less','public/assets/css/elements.css');
//    mix.less('ubold-template/icons.less','public/assets/cssicons.css');
//    mix.less('ubold-template/pages.less','public/assets/css/pages.css');
//    mix.less('ubold-template/responsive.less','public/assets/css/responsive.css');
//    mix.less('ubold-template/variables.less', 'public/assets/cssvariables.css');
    mix.scripts([
        '../../angular/common/*.js',
        '../../angular/common/**/*.js',        
        '../../angular/contexts/admin/controllers/*.js',
        '../.../angular/contexts/admin/*.js'
    ], 'public/js/estrasol/app.js');
    mix.scripts([
         '../../angular/contexts/web/app.js',
        '../../angular/common/*.js',
        '../../angular/common/**/*.js',
        '../../angular/contexts/web/controllers/*.js',
       
        
    ], 'public/js/estrasol/web-angular.js');
    mix.livereload();
});
