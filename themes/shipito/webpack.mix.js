const mix = require("laravel-mix");

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
 


mix.js(`${__dirname}/assets/js/app.js`, "public/themes/easyship/custom-assets/js")
   .sass(`${__dirname}/assets/sass/app.scss`, "public/themes/easyship/custom-assets/css");