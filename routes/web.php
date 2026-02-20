<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


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

Route::get('/home', [HomeController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);
Route::get('/contact/create', [ContactController::class, 'create']);
Route::get('/contact/{contact}/show', [ContactController::class, 'show']);



Route::post('/contact/create', [ContactController::class, 'store']);


Route::get('/contact/{contact}/edit', [ContactController::class, 'edit']);
Route::put('/contact/{contact}/edit', [ContactController::class, 'update']);


Route::delete('/contact/{contact}/delete', [ContactController::class, 'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
