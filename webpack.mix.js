const mix = require('laravel-mix');
const path = require('path');

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

mix.js('resources/assets/global/js/app.js', 'public/assets/global/js')
    .js('resources/assets/custom/js/custom.js', 'public/assets/custom/js')

    .sass('resources/assets/global/sass/app.scss', 'public/assets/global/css')
    .sass('resources/assets/custom/sass/custom.scss', 'public/assets/custom/css')
    .sass('resources/assets/custom/sass/acl.scss', 'public/assets/custom/css')
    .sass('resources/assets/custom/sass/menus.scss', 'public/assets/custom/css')

    .sourceMaps(!mix.inProduction(), 'source-map');
    
mix.override((webpackConfig) => {
  webpackConfig.resolve.modules = [`${__dirname}/vendor/spatie/laravel-medialibrary-pro/resources/js`, 'node_modules'];
});


let module_name = process.env.npm_config_module;

if (module_name == 'Localization' || module_name == 'all') {
  require(`${__dirname}/Modules/Localization/webpack.mix.js`);
}
if (module_name == 'Blog' || module_name == 'all') {
  require(`${__dirname}/Modules/Blog/webpack.mix.js`);
} //
if (module_name == 'Widget' || module_name == 'all') {
  require(`${__dirname}/Modules/Widget/webpack.mix.js`);
} //
if (module_name == 'Setting' || module_name == 'all') {
  require(`${__dirname}/Modules/Setting/webpack.mix.js`);
} //



// Themes
let theme = process.env.npm_config_theme;

if(theme) {
   require(`${__dirname}/themes/${theme}/webpack.mix.js`);
} else {
    // default theme to compile if theme is not specified
  require(`${__dirname}/themes/easyship/webpack.mix.js`);
}


// mix.disableNotifications();