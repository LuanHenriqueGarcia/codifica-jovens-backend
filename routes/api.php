<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');


Route::get('/users', [UserController::class, 'index'])->name('api.users.index');

// Rota POST para criar um novo usuário
Route::post('/users', [UserController::class, 'store'])->name('api.users.store');

Route::post('/login', [UserController::class, 'login'])->name('api.users.login');

// Rota GET para obter um usuário específico pelo ID
Route::get('/users/{id}', [UserController::class, 'show'])->name('api.users.show');

// Rota PUT para atualizar um usuário existente
Route::put('/users/{id}', [UserController::class, 'update'])->name('api.users.update');

// Rota DELETE para excluir um usuário pelo ID
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('api.users.destroy');
