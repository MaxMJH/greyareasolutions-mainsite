const mix = require('laravel-mix');

mix.js('resources/js/scripts.js', 'public/js')
  .js('resources/js/blogs.js', 'public/js')
  .js('resources/js/login.js', 'public/js')
  .js('resources/js/accounts.js', 'public/js')
  .css('resources/css/greyareasolutions_main.css', 'public/css')
  .css('resources/css/login.css', 'public/css')
  .css('resources/css/blogs.css', 'public/css')
  .css('resources/css/blog.css', 'public/css')
  .css('resources/css/blog_editorial.css', 'public/css')
  .css('resources/css/accounts.css', 'public/css')
  .copyDirectory('resources/images', 'public/images')
  .version();
