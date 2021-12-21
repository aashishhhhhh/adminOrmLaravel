<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\userController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::post('signup',[userController::class,'signup']);
Route::get('/loginform',[userController::class,'loginShow']);
Route::post('login',[userController::class,'login']);
Route::get('/signUpform',[userController::class,'signUpShow']);

Route::middleware(['protectedPage'])->group(function () {
    Route::get('dashboard',[userController::class,'dashboardShow']);
    Route::post('add',[userController::class,'addUser']);
    Route::post('edit',[userController::class,'edit']);
    Route::get('delete/{id}',[userController::class,'delete']);
    Route::get('logout',[userController::class,'logout']);
    Route::get('addPost',[PostController::class,'addPost']);
    Route::post('addPosts',[PostController::class,'createPost']);
    Route::get('seePost',[PostController::class,'seePost']);
    Route::get('showPost/{id}',[PostController::class,'showPost']);
});



