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
//elixir.config.assetsDir = './public/';

elixir(function (mix) {
    mix.styles([
        'bower_components/bootstrap/dist/css/bootstrap.min.css',
        'bower_components/bootstrap-rtl/dist/css/bootstrap-rtl.css',
        'bower_components/fontawesome/css/font-awesome.min.css',
        'css/jplayer.css',
        'css/style.css'
    ], 'public/css/all.css', 'public');

    mix.scripts([
        'bower_components/jquery/dist/jquery.min.js',
        'bower_components/bootstrap/dist/js/bootstrap.min.js',
        'bower_components/jplayer/dist/jplayer/jquery.jplayer.min.js',
        'bower_components/jquery-ui/jquery-ui.min.js',
        'js/script.js'
    ], 'public/js/app.js', 'public');

    elixir(function (mix) {
        mix.version(['css/all.css', 'js/app.js']);
        //mix.version(['js/app.js']);
    });

});
