<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController; 


Route::middleware('auth:sanctum')->group(function() {
  Route::get('/posts', [PostController::class, 'index']);
  Route::post('/posts', [PostController::class, 'store']);
  Route::get('/posts/{id}', [PostController::class, 'show']);
  
  Route::post('/posts/{id}/comments', [CommentController::class, 'store']);
});
  Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');
  Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
  return User::all();
});


Route::post('/contacts', [ContactController::class, 'store']);
Route::post('/login', [UserController::class, 'login'])->name('api.users.login');
Route::get('/login', [UserController::class, 'login'])->name('api.users.login');


Route::get('/users', [UserController::class, 'index'])->name('api.users.index');
Route::post('/users', [UserController::class, 'store'])->name('api.users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->name('api.users.show');
Route::put('/users/{id}', [UserController::class, 'update'])->name('api.users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('api.users.destroy');
  