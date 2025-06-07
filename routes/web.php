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
    Route::post('/posts/{post}/toggle-Like', [PostController::class, 'toggleLike'])->name('posts.toggleLike');
    Route::post('/posts/{post}/make-comment', [PostController::class, 'makeComment'])->name('posts.makeComment');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
});
Route::get('/',[HomeController::class, 'getHome'])->name('home.index');
Route::get('/posts/filter/category', [PostController::class, 'filterByCategory'])->name('posts.filterByCategory');
Route::get('/posts/filter/likes', [PostController::class, 'orderPostsBy'])->name('posts.orderPostsBy');
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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
    Route::get('/admin/users', [ProfileController::class, 'getUsers'])->name('admin.users');
    Route::get('/admin/users/edit/{id}', [ProfileController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/update/{id}', [ProfileController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/delete/{id}', [ProfileController::class, 'destroyUser'])->name('admin.users.delete');
});

require __DIR__.'/auth.php';
