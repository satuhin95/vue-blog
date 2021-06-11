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
    .sass('resources/sass/app.scss', 'public/css');
   
   
    // frontend 
//  mix.sass('resources/sass/assets/app.scss', 'public/css/style.css');

// mix.styles([
//     'resources/sass/assets/css/bootstrap.min.css',
//     'resources/sass/assets/css/plugins/hover.css',
//     'resources/sass/assets/css/plugins/slicknav.css',
//     'resources/sass/assets/css/plugins/animate.css',
//     'resources/sass/assets/css/plugins/owl.carousel.css',
//     'resources/sass/assets/css/font-awesome.css',
//     'resources/sass/assets/css/reset.css',
//     'resources/sass/assets/css/style.css',
//     'resources/sass/assets/css/responsive.css',
 
// ], 'public/css/all.css');
 
 
 mix.js('resources/js/app2.js', 'public/js/app2.js');
//  mix.scripts([
//     'resources/sass/assets/js/jquery-3.3.1.min.js',
//     'resources/sass/assets/js/jquery-migrate.min.js',
//     'resources/sass/assets/js/popper.min.js',
//     'resources/sass/assets/js/bootstrap.min.js',
//     'resources/sass/assets/js/plugins/owl.carousel.min.js',
//     'resources/sass/assets/js/plugins/waypoints.min.js',
//     'resources/sass/assets/js/plugins/counterup.min.js',
//     'resources/sass/assets/js/plugins/parallax-1.1.3.js',
//     'resources/sass/assets/js/plugins/jquery.slicknav.min.js',
//     'resources/sass/assets/js/main.js',
   
// ], 'public/js/all.js');
     


