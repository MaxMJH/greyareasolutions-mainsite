const mix = require('laravel-mix');

mix.js('resources/js/scripts.js', 'public/js')
  .css('resources/css/style.css', 'public/css')
  .css('resources/css/login.css', 'public/css')
  .copyDirectory('resources/images', 'public/images')
  .version();
