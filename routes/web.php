<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('greyareasolutions_main');
});

Route::get('/login', function() {
    return view('login');
});

Route::get('/blogs', function () {
    return view('all_blogs');
});

Route::get('/blog', function () {
    return view('blog');
});
