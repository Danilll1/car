<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReqController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [UserController:: class, 'indexReg'])->name('reg');
Route::post('/register', [UserController:: class, 'register'])->name('register.store');

Route::get('/login', [UserController:: class, 'index'])->name('login');
Route::post('/login', [UserController:: class, 'auth'])->name('auth');

// Route::get('/home', [HomeController:: class, 'index'])->name('home');

Route::get('/requests', [ReqController:: class, 'index'])->name('req');
Route::post('/requests', [ReqController:: class, 'store'])->name('request.store');
Route::delete('/request/{id}', [ReqController::class, 'destroy'])->name('request.destroy');

Route::get('/admin', [AdminController:: class, 'index'])->name('admin');
Route::post('/admin', [AdminController:: class, 'edit'])->name('admin.edit');
Route::delete('/admin/request/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');






