<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PostController, SearchController, CategoryController, TagController};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// search
Route::get('search', [SearchController::class, 'post'])->name('search.post');

// post
Route::middleware('auth')->group(function(){
    Route::get('posts', [PostController::class , 'index'])->name('posts.index')->withoutMiddleware('auth');
    Route::get('posts/create', [PostController::class , 'create'])->name('posts.create');
    Route::post('posts/store', [PostController::class , 'store'])->name('posts.store');
    Route::get('posts/{post:slug}/edit', [PostController::class , 'edit'])->name('posts.edit');
    Route::patch('posts/{post:slug}/edit', [PostController::class , 'update'])->name('posts.update');
    Route::get('posts/{post:slug}', [PostController::class , 'show'])->name('posts.show')->withoutMiddleware('auth');
    Route::delete('posts/{post:slug}/delete', [PostController::class , 'destroy'])->name('posts.destroy');
});

// Category

Route::get('category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');

// Tags
Route::get('tags/{tag:slug}', [TagController::class, 'show'])->name('tags.show');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
