const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/project-members.js', 'public/js')
    .sass('resources/sass/project/index.scss', 'public/css/project')
    .sass('resources/sass/project/show.scss', 'public/css/project')
    .sass('resources/sass/project/members.scss', 'public/css/project')
    .sass('resources/sass/app.scss', 'public/css');
