<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PostsController;

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//User Related Routes
Route::get('/',[UserController::class,"showCorrectHomepage"])->name('login');
Route::post('/register', [UserController::class,"register"]);
Route::post('/login',[UserController::class,"login"]);
Route::post('/logout',[UserController::class,"logout"])->middleware('auth');

//Blog Posts Related Routes
Route::get('/create-post',[PostsController::class,"showPostForm"])->middleware('MustBeLoggedIn');
Route::post('/create-post',[PostsController::class,"registerPost"])->middleware('guest');
Route::get('/post/{post}',[PostsController::class,"viewSinglePost"]);

//Profile Related Routes
Route::get('/profile/{user:username}',[UserController::class,'showProfile']);
