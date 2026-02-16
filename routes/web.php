<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Contact;
use Illuminate\Support\Facades\Route;

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

Route ::get('/home',[HomeController::class, 'index'] );

Route ::get('/contact',[ContactController::class, 'index'] );
Route ::get('/contact/create',[ContactController::class, 'create'])->name('contact.create');
Route ::get('/contact/create',[ContactController::class, 'edit'])->name('contact.edit');
Route ::get('/contact/create',[ContactController::class, 'show'])->name('contact.show');
// Route ::get('/contact/create',[ContactController::class, ''])->name('contact.create');

