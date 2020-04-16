let mix = require('laravel-mix');

/* Base JS */
mix.scripts([
    // 'resources/js/_libraries/jquery-3.5.0.min.js',
    // 'resources/js/_libraries/popper.min.js',
    // 'resources/js/_libraries/bootstrap.min.js',
    'resources/js/app.js',
], 'public/js/app.js');

/* Compile sass  */
mix.sass('resources/sass/app.scss', '../resources/css/_compiled/app.css');

/* Main css */
mix.styles([
    'resources/css/_libraries/bootstrap.min.css',
    'resources/css/_compiled/app.css'
], 'public/css/app.css');



if (mix.inProduction()) {
    mix.version();
}
