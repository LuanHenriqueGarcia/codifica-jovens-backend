<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;



Route::post('/contacts', [ContactController::class, 'store']);

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
  return User::all();
});

Route::get('/users', [UserController::class, 'index'])->name('api.users.index');

Route::post('/users', [UserController::class, 'store'])->name('api.users.store');

Route::post('/login', [UserController::class, 'login'])->name('api.users.login');

Route::get('/login', [UserController::class, 'login'])->name('api.users.login');

Route::get('/users/{id}', [UserController::class, 'show'])->name('api.users.show');

Route::put('/users/{id}', [UserController::class, 'update'])->name('api.users.update');

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('api.users.destroy');

