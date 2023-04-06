<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\GradebooksController;
use App\Http\Controllers\CommentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/active-user', [AuthController::class, 'getActiveUser']);

Route::get('/teachers', [UsersController::class, 'getAll']);
Route::get('/teachers/{id}', [UsersController::class, 'show']);

Route::get('/gradebooks', [GradebooksController::class, 'getAll']);
Route::get('/gradebooks/{id}', [GradebooksController::class, 'show']);
Route::post('/gradebooks', [GradebooksController::class, 'store']);
Route::put('/gradebooks/{id}', [GradebooksController::class, 'update']);
Route::delete('/gradebooks/{id}', [GradebooksController::class, 'delete']);

Route::get('/students', [StudentsController::class, 'getAll']);
Route::post('/students', [StudentsController::class, 'store']);

Route::get('/comments', [CommentsController::class, 'getAll']);
Route::post('/comments', [CommentsController::class, 'store']);
Route::delete('/comments/{id}', [CommentsController::class, 'delete']);


