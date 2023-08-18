<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\AccountsController;
use App\Enums\RoleEnum;

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

Route::get('/blogs', function () {
    return view('all_blogs');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog-edit', function() {
    return view('blog_editorial');
});
