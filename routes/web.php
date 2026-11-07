<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WikipediaController;
use App\Http\Controllers\ChirpController;

Route::get('/wikipedia', [WikipediaController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello');
});

use App\Http\Controllers\HelloController;
Route::get('/control', [HelloController::class, 'index']);

use App\Http\Controllers\ProductController;
Route::get('/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/create', [ProductController::class, 'store'])->name('products.store');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::redirect('/home', '/chirps');

// use App\Http\Controllers\AjaxController;

// // Route::get('/', function () {
// //     return view('home');
// // });

// Route::get('/ajax', [AjaxController::class, 'index']);
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');
    Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy'])->name('chirps.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
