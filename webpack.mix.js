const mix = require('laravel-mix');
const LiveReloadPlugin = require('webpack-livereload-plugin');
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

mix
  .js('resources/js/app.js', 'public/js')
  .version()
  .js('resources/js/admin.js', 'public/js')
  .version()
  .js('resources/js/doctor.js', 'public/js')
  .version()
  .js('resources/js/center.js', 'public/js')
  .version()
  .sass('resources/sass/app.scss', 'public/css')
  .sourceMaps()
  .version()
  .sass('resources/sass/vendor.scss', 'public/css')
  .sourceMaps()
  .version()
  .sass('resources/sass/doctor.scss', 'public/css')
  .sourceMaps()
  .version()
  .sass('resources/sass/admin.scss', 'public/css')
  .sourceMaps()
  .version();
mix.webpackConfig({
  plugins: [new LiveReloadPlugin()],
});
