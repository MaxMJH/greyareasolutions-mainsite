<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// TEMP ROUTE.
// Utilise the AccouuntController's 'getAccountsView' method.
Route::get('/accounts', function() {
    return view('accounts');
});

Route::get('/blogs', function () {
    return view('all_blogs');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/blog-edit', function() {
    return view('blog_editorial');
});
