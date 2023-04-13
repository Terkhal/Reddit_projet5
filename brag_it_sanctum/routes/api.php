<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\commentsController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\PostsController;
use Laravel\Sanctum\Sanctum;

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

Route::get("/categories/top", [DataController::class, "topCat"]);
Route::get("/", [DataController::class, "allIn"]);
Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

Route::get('posts/user/{user}', [PostsController::class, 'getPostfromUser']);

Route::resource('users', UserController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('comments', commentsController::class);
Route::get('comments/category/{category}', [commentsController::class, 'getComfromCat']);
Route::get('comments/post/{post}', [commentsController::class, 'getComfromPost']);
Route::resource('posts', PostsController::class);
// ->middleware('auth:sanctum');
Route::get('posts/category/{category}', [PostsController::class, 'getPostfromCat']);

Route::get('data', [DataController::class, 'alldatacount']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
