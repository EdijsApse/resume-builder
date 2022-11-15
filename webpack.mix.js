const mix = require('laravel-mix');
const path = require('path');

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

mix.alias({
    '@': path.join(__dirname, 'resources/js'),
    '@style': path.join(__dirname, 'resources/sass'),
    '@components': path.join(__dirname, 'resources/js/components'),
});

mix.sass('resources/sass/style.scss', 'public/css').options({processCssUrls: false});
mix.js('resources/js/app.js', 'public/js').vue();
mix.copyDirectory('resources/assets/fonts', 'public/fonts');
mix.copyDirectory('resources/assets/images', 'public/images');