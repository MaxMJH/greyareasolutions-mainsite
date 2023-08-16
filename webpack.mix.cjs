const mix = require('laravel-mix');

mix.js('resources/js/landingscript.js', 'public/js')
  .js('resources/js/pagelayout.js', 'public/js')
  .js('resources/js/errorpopup.js', 'public/js')
  .js('resources/js/accounts.js', 'public/js')
  .js('resources/js/modal.js', 'public/js')
  .css('resources/css/greyareasolutions_main.css', 'public/css')
  .css('resources/css/login.css', 'public/css')
  .css('resources/css/create_account.css', 'public/css')
  .css('resources/css/blogs.css', 'public/css')
  .css('resources/css/blog.css', 'public/css')
  .css('resources/css/blog_editorial.css', 'public/css')
  .css('resources/css/accounts.css', 'public/css')
  .css('resources/css/edit_account_modal.css', 'public/css')
  .css('resources/css/view_account_modal.css', 'public/css')
  .css('resources/css/confirmation_modal.css', 'public/css')
  .copyDirectory('resources/images', 'public/images')
  .version();
