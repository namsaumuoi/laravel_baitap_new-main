<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgeController;
use App\Http\Controllers\CategoryController;

/*
 Home
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
 Product group
*/
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/add', [ProductController::class, 'create'])->name('product.add');
    Route::post('/add', [ProductController::class, 'store'])->name('product.store');
    // id kiểu chuỗi, mặc định '123'
    Route::get('/{id?}', [ProductController::class, 'show'])->name('product.show')->where('id', '.*');
});

/*
 Category group
*/
Route::resource('categories', CategoryController::class);

/*
 Sinh viên
 name, mssv có giá trị mặc định
*/
Route::get('/sinhvien/{name?}/{mssv?}', [StudentController::class, 'show'])
    ->name('student.show')
    ->defaults('name', 'Nguyen Danh Duoc')
    ->defaults('mssv', '0305467');

/*
 Banco (bàn cờ) n x n
*/
Route::get('/banco/{n}', [HomeController::class, 'banco'])->name('banco');

/*
 Fallback -> 404 view
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// SignIn
Route::get('/signin', [AuthController::class, 'signIn'])->name('auth.signin');
Route::post('/signin', [AuthController::class, 'checkSignIn'])->name('auth.checksign');

// Age form + protected route
Route::get('/age', [AgeController::class, 'showForm'])->name('age.form');
Route::post('/age', [AgeController::class, 'store'])->name('age.store');
// Route::get('/protected-area', [AgeController::class, 'protected'])->middleware(\App\Http\Middleware\CheckAge::class)->name('age.protected');    