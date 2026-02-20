<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('welcome');
});


Route::get(uri: '/contacts', action: [ContactController::class, 'index']);

Route::get('/contacts', action: [ContactController::class, 'index']);
Route::get('/contacts/{contact}/show', [ContactController::class, 'show']);

Route::get('/contacts/create', [ContactController::class, 'create']);
Route::post('/contacts/create', [ContactController::class, 'store']);

Route::get('/contacts/{id}', [ContactController::class, 'show']);
Route::get('/contacts/{id}/edit', [ContactController::class, 'edit']);
Route::put('/contacts/{id}', [ContactController::class, 'update']);
Route::delete('/contacts/{id}', [ContactController::class, 'destroy']);          







Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
