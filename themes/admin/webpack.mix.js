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


mix.setPublicPath("public/themes/admin")
    .ts(`${__dirname}/js/index.tsx`, "js/app.js")
    .react().sourceMaps()

mix.browserSync('orderme.test');