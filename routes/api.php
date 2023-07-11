<?php

use App\Http\Controllers\APIS\PostControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('/unauthorized', function(){
    return [
        "message"=>"unauthorized"
    ];

})->name('unauthorized');


Route::get('/posts', [PostControllerApi::class, 'posts']);
Route::get('/post/{post}', [PostControllerApi::class, 'post']);
Route::get('/category/{category:name}', [PostControllerApi::class, 'category']);
Route::get('/author/{user:name}', [PostControllerApi::class, 'user']);



// Authentication
// Route::controller(AuthController::class)->group(function(){
//     Route::post('/register', 'register')->name('register');
//     Route::post('/login',  'login')->name('login');
    

// });



//Routes that require tokens
// Route::group(['middleware' => ['auth:sanctum']], function(){
//     Route::get('/posts', [PostControllerApi::class, 'posts']);
 

// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
