const mix = require('laravel-mix');

mix.js('resources/js/scripts.js', 'public/js')
  .copy('resources/css', 'public/css')
  .copyDirectory('resources/images', 'public/images')
  .version();
