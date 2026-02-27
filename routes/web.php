<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
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

Route::get('/contact', [ContactController::class,'index']);
Route::get('/contact/{contact}/show', [ContactController::class,'show']);

Route::get('/contact/create', [ContactController::class,'create']);
Route::post('/contact/create', [ContactController::class,'store']);

Route::get('/contact/{contact}/edit', [ContactController::class,'edit']);
Route::put('/contact/{contact}/edit', [ContactController::class,'update']);

Route::delete('/contact/{contact}/delete', [ContactController::class,'destroy']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 💳 Routes Gestion des Paiements - Authentifiées
Route::middleware(['auth'])->group(function () {
    // CRUD Paiements
    Route::resource('payments', PaymentController::class);
    
    // Actions spéciales
    Route::post('/payments/{payment}/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');
    Route::post('/payments/{payment}/cancel', [PaymentController::class, 'cancel'])->name('payments.cancel');
    
    // Rapport & Filtres
    Route::get('/payments/report/generate', [PaymentController::class, 'report'])->name('payments.report');
});
