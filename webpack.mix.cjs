const mix = require('laravel-mix');

mix.js('resources/js/scripts.js', 'public/js')
  .js('resources/js/blogs.js', 'public/js')
  .css('resources/css/style.css', 'public/css')
  .css('resources/css/login.css', 'public/css')
  .css('resources/css/blogs.css', 'public/css')
  .css('resources/css/blog.css', 'public/css')
  .copyDirectory('resources/images', 'public/images')
  .version();
