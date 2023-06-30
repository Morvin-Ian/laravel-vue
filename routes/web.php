<?php

use App\Http\Controllers\PostController;
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

Route::controller(PostController::class)->group(function(){
    Route::get('/', 'index')->name('posts');
    Route::get('/post/{post:slug}/', 'show')->name('post');
    Route::get('/category/{category:slug}', 'category')->name('category');
    Route::get('/author/{user:name}/', 'author')->name('author');


});
