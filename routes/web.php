<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controller\EmprestimoController;
use App\Http\Controller\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controller\UserController;

Route::get('/users', [UserController::class, 'index']);

Route::get('/', [IndexController::class, 'index']);
Route::get('login', [LoginController::class, 'redirectToProvider'])->name('login');
Route::get('logout', [LogoutController::class, 'logout']);
Route::get('callback', [LoginController::class, 'handleProviderCallback']);


Route::resource('emprestimo', EmprestimoController::class);
Route::get('fila', [EmprestimoController::class, 'fila']);

Route::get('emprestimo/{emprestimo}/devolver', [EmprestimoController::class, 'devolver_form']);
Route::patch('devolver/{emprestimo}', [EmprestimoController::class, 'devolver']);
