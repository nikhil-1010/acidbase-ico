const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix.scripts([
    "resources/assets/js/jquery.min.js",
    "resources/assets/js/bootstrap.bundle.min.js",
    "resources/assets/js/common.js",
    "resources/assets/js/custom.js",
], 'public/assets/js/admin_app.min.js')
.styles([
    "resources/assets/css/all.min.css",
    "resources/assets/css/bootstrap.min.css",
    "resources/assets/css/style.css",
], "public/assets/css/admin_app.min.css")