<?php

use App\Http\Controllers\PostController;
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

Route::middleware(['auth'])->group(function(){
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/delete/{id}', [PostController::class, 'destroy'])->name('posts.delete');
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/comment', [PostController::class, 'comment'])->name('posts.comment');
});
Route::get('/',[HomeController::class, 'getHome'])->name('home.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
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
