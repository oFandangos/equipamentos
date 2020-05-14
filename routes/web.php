<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'IndexController@index');
Route::get('login', 'Auth\LoginController@redirectToProvider');
Route::get('logout', 'Auth\LogoutController@logout');
Route::get('callback', 'Auth\LoginController@handleProviderCallback');
