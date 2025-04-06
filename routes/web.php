<?php

use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\PostController;
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
    return view('layouts.home');
})->name('home');

Route::name('posts.')
    ->prefix('posts')
    ->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::get('/{id}', [PostController::class, 'show'])->whereNumber('id')->name('show');
        Route::get('/create', [PostController::class, 'create'])->name('create');
        Route::post('/', [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');
        Route::get('/download', [PostController::class, 'download'])->name('download');
    }
);
Route::name('categories.')
    ->prefix('categories')
    ->group(function () {
        Route::get('/', [CategoryPostController::class, 'index'])->name('index');
        Route::get('/{category}', [CategoryPostController::class, 'show'])->name('show');
    }
);
//TODO внесите в группу posts
// Route::get('/posts/categories', [CategoryPostController::class, 'index'])->name('posts.categories.index');
// Route::get('/posts/categories/{category}', [CategoryPostController::class, 'show'])->name('posts.categories.show');


// TODO: GET + PUT (Обновление поста) (@method('PUT') внутри формы blade при обновлении)
// TODO: DELETE (Удаление поста) (/post/{id})
