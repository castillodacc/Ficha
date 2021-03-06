let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js');
mix.copy(
    [
        'node_modules/jquery/dist/jquery.js',
        'node_modules/timepicker/jquery.timepicker.js',
        'node_modules/datepair.js/dist/jquery.datepair.js',
        'node_modules/datepair.js/dist/datepair.js',
    ],
    'public/js'
);


mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.copy('node_modules/timepicker/jquery.timepicker.css', 'public/css');
