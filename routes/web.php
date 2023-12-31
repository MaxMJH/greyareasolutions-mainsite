<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\AccountsController;
use App\Enums\RoleEnum;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Essentially the landing page route, returns the main view.
Route::get('/', function () {
    return view('greyareasolutions_main');
});

// Utilise the UserController's 'getLoginView' method.
Route::get('/login', [UserController::class, 'getLoginView']);

// Utilise the UserController's 'postLoginAuthenticate' method.
Route::post('/login', [UserController::class, 'postLoginAuthenticate']);

// Utilise the UserController's 'postLogout' method.
Route::post('/logout', [UserController::class, 'postLogout']);

// Utilise the CreateAccountController's 'getCreateAccountView' method.
Route::get('/create_account', [CreateAccountController::class, 'getCreateAccountView']);

// Utilise the CreateAccountController's 'postCreateAccount' method.
Route::post('/create_account', [CreateAccountController::class, 'postCreateAccount']);

// Utilise the AccountController's 'getAccountsView' method.
Route::get('/accounts', [AccountsController::class, 'getAccountsView'])->middleware('checkRole:' . RoleEnum::Admin->value);

// Utilise the AccountController's 'postAccounts' method.
Route::post('/accounts', [AccountsController::class, 'postAccounts'])->middleware('checkRole:' . RoleEnum::Admin->value);

// Utilise the AccountController's 'postAddAccount' method.
Route::post('/accounts/view', [AccountsController::class, 'postViewAccount'])->middleware('checkRole:' . RoleEnum::Admin->value);

// Utilise the AccountController's 'getAllUsers' method.
Route::get('/accounts/allusers', [AccountsController::class, 'getAllUsers'])->middleware(['checkRole:' . RoleEnum::Admin->value, 'checkReferrer:/accounts']);

// Utilise the AccountController's 'postEditAccount' method.
Route::post('/accounts/edit', [AccountsController::class, 'postEditAccount'])->middleware('checkRole:' . RoleEnum::Admin->value);

// Utilise the AccountsController's 'postUpdateAccount' method.
Route::post('/accounts/update', [AccountsController::class, 'postUpdateAccount'])->middleware('checkRole:' . RoleEnum::Admin->value);

// Utilise the AccountController's 'postRemoveAccount' method.
Route::post('/accounts/remove', [AccountsController::class, 'postRemoveAccount'])->middleware('checkRole:' . RoleEnum::Admin->value);

// Utilise the BlogController's 'getBlogsView' method.
Route::get('/blogs', [BlogController::class, 'getBlogsView']);

// Utilise the BlogController's 'getRecentBlogs' method.
Route::get('/blog/recentblogs', [BlogController::class, 'getRecentBlogs']);

// Utilise the BlogController's 'getCreateBlog' method.
Route::get('/blog/create', [BlogController::class, 'getCreateBlog'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value);

// Utilise the BlogController's 'postCreateBlog' method.
Route::post('/blog/create', [BlogController::class, 'postCreateBlog'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value);

// Utilise the BlogController's 'getBlogConfirm' method.
Route::get('/blog/create/confirm', [BlogController::class, 'getCreateBlogConfirm'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value, 'checkReferrer:/create');

// Utilise the BlogController's 'getEditBlog' method.
Route::get('/blog/{blog:blog_slug}/edit', [BlogController::class, 'getEditBlog'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value)->name('blog.edit');

// Utilise the BlogController's 'postEditBlog' method.
Route::post('/blog/{blog:blog_slug}/edit', [BlogController::class, 'postEditBlog'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value);

// Utilise the BlogController's 'getEditBlogConfirm' methood.
Route::get('/blog/{blog:blog_slug}/edit/confirm', [BlogController::class, 'getEditBlogConfirm'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value, 'checkReferrer:/edit');

// Utilise the BlogController's 'getRemoveBlogConfirm' method.
Route::get('/blog/{blog:blog_slug}/remove/confirm', [BlogController::class, 'getRemoveBlogConfirm'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value, 'checkReferrer:/blog');

// Utilise the BlogController's 'postRemoveBlog' method.
Route::post('/blog/{blog:blog_slug}/remove', [BlogController::class, 'postRemoveBlog'])->middleware('checkRole:' . RoleEnum::Admin->value . ',' . RoleEnum::Blogger->value);

// Utilise the BlogController's 'getBlogView' method.
Route::get('/blog/{blog:blog_slug}', [BlogController::class, 'getBlogView']);
