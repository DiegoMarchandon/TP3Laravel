<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
/* idea: hacer un about */
/* 
Route::get('/about', function () {
    return view('about');
})->name('about'); */

Route::get('/',[HomeController::class, 'getHome'])->name('home.index');
Route::get('/category',[CategoryController::class, 'getIndex'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'getCreate'])->name('category.create');
Route::get('/category/show/{id}', [CategoryController::class, 'getShow'])->name('category.show');
Route::get('/category/edit/{id}', [CategoryController::class, 'getEdit'])->name('category.edit');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
