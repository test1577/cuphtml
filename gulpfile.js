var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss')
        .scripts([
            // Combine all js files into one.
            // Path is relative to resource/js folder.
            '../../bower_components/jquery/dist/jquery.min.js',
            '../../bower_components/velocity/velocity.min.js',
            '../../bower_components/moment/min/moment-with-locales.min.js',
            '../../bower_components/angular/angular.min.js',
            '../../bower_components/lumx/dist/lumx.min.js',
        ], 'public/js/app.js')
        // Since css file will be place into public/css folder,
        // we need to copy font files too
        .copy('bower_components/mdi/fonts', 'public/fonts');
});


