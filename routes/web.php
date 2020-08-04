<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index');
Route::get('login', 'Auth\LoginController@redirectToProvider')->name('login');
Route::get('logout', 'Auth\LogoutController@logout');
Route::get('callback', 'Auth\LoginController@handleProviderCallback');


Route::resource('emprestimo', 'EmprestimoController');
Route::get('fila', 'EmprestimoController@fila');

Route::get('emprestimo/{emprestimo}/devolver', 'EmprestimoController@devolver_form');
Route::patch('devolver/{emprestimo}', 'EmprestimoController@devolver');