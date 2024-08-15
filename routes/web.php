<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmprestimoController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/users', [UserController::class, 'index']);

Route::get('/', [IndexController::class, 'index']);

Route::resource('emprestimo', EmprestimoController::class);
Route::get('fila', [EmprestimoController::class, 'fila']);

Route::get('emprestimo/{emprestimo}/devolver', [EmprestimoController::class, 'devolver_form']);
Route::get('devolver_direto/{emprestimo}', [EmprestimoController::class, 'devolver_direto']);
Route::patch('devolver/{emprestimo}', [EmprestimoController::class, 'devolver']);

# Logs  
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('can:admin');
