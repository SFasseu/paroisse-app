<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
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
// Route::resource('contact',ContactController::class);
Route::get('/contact',[ContactController::class,'index'])->name("contact");
Route::get('/contact/create',[ContactController::class,'create'])->name("contact.create");
Route::post('/contact/create',[ContactController::class,'store']);
Route::get('/contact/{contact}/show',[ContactController::class,'show'])->name("contact.show");
Route::get('/contact/{contact}/edit',[ContactController::class,'edit'])->name('contact.edit');
Route::post('/contact/{contact}/edit',[ContactController::class,'update'])->name("contact.update");
Route::delete('/contact/{contact}/delete',[ContactController::class,'destroy'])->name("contact.delete");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name("home");
