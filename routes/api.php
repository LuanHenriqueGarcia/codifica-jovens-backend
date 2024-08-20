<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\AlunoController;

Route::apiResource('turmas', TurmaController::class);
Route::apiResource('alunos', AlunoController::class);

