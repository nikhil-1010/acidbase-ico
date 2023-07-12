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
    "resources/assets/js/jquery.form.min.js",
    "resources/assets/js/bootstrap.bundle.min.js",
    "resources/assets/js/common.js",
    "resources/assets/js/custom.js",
], 'public/assets/js/admin_app.min.js')
.scripts([

    "resources/assets/js/jquery.min.js",
    "resources/assets/js/jquery.form.min.js",
    "resources/assets/js/bootstrap.bundle.min.js",
    "resources/assets/js/common.js",
    "resources/assets/js/custom.js",
    "resources/assets/js/config.js",
    "resources/assets/js/portfolio.js",
    "resources/assets/js/walletconnect.js",
], "public/assets/js/portfolio.min.js")
.scripts([
    "resources/assets/js/jquery.min.js",
    "resources/assets/js/jquery.form.min.js",
    "resources/assets/js/bootstrap.bundle.min.js",
    "resources/assets/js/slick.js",
    "resources/assets/js/chart.min.js",
    "resources/assets/js/common.js",
    "resources/assets/js/custom.js",
    "resources/assets/js/home.js",
], "public/assets/js/home.min.js")
.scripts([
    "./resources/assets/js/web3.min.js",
    "./resources/assets/js/web3modal.js",
    "./resources/assets/js/web3-provider.min.js",
], './public/assets/js/web3.min.js')
.scripts([
    "resources/assets/js/admin/profile.js",
], "public/assets/js/admin/profile.min.js")
.scripts([
    "resources/assets/js/admin/whitelist.js",
], "public/assets/js/admin/whitelist.min.js")
.scripts([
    "resources/assets/js/admin/transaction.js",
], "public/assets/js/admin/transaction.min.js")
.scripts([
    "resources/assets/js/admin/setting.js",
], "public/assets/js/admin/setting.min.js")
.scripts([
    "resources/assets/js/admin/faq.js",
], "public/assets/js/admin/faq.min.js")
.scripts([
    "resources/assets/js/admin/site_content.js",
], "public/assets/js/admin/site_content.min.js")
.scripts([
    "resources/assets/js/admin/contact_us.js",
], "public/assets/js/admin/contact_us.min.js")
.scripts([
    "resources/assets/js/jquery.min.js",
    "resources/assets/js/jquery.form.min.js",
    "resources/assets/js/bootstrap.bundle.min.js",
    "resources/assets/js/slick.js",
    "resources/assets/js/chart.min.js",
    "resources/assets/js/common.js",
    "resources/assets/js/custom.js",
    "resources/assets/js/contact_us.js",
], "public/assets/js/contact_us.min.js")
.styles([
    "resources/assets/css/all.min.css",
    "resources/assets/css/slick-slider.css",
    "resources/assets/css/bootstrap.min.css",
    "resources/assets/css/style.css",
], "public/assets/css/admin_app.min.css")