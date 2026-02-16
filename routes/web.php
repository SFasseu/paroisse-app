<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

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

Route::get('/home',[HomeController::class , 'index']);
Route::get('/contact',[ContactController::class , 'index']);
Route::get('/create',[ContactController::class ,'create'])->name('contact.create');
Route::post('/store',[ContactController::class, 'store' ])->name('contact.store');
Route::delete('/delete',[ContactController::class, 'destroy'])->name('contact.destroy');
Route::put('/edit', [ContactController::class, 'edit'])->name('contact.edit');