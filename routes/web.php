<?php

use App\Http\Controllers\User_Controller;
use Illuminate\Support\Facades\Route;

Route::view('/login', 'login_page')->name('login');
Route::post('/login', [User_Controller::class,'login_function'])->name('login_function');

Route::view('/signin', 'signin_page')->name('signin');
Route::post('/signin', [User_Controller::class,'signin_function'])->name('signin_function');

Route::get('/', [User_Controller::class,'home_function'])->name('home');
Route::get('/logout', [User_Controller::class,'logout_function'])->name('logout');
