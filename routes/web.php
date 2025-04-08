<?php

use App\Http\Controllers\CategoryPostController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\TestPostMiddleware;
use App\Http\Middleware\TestPreMiddleware;
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

Route::prefix('test')->group(function () {
    Route::get('/', function () {
        return 'test';
    });
});

Route::controller(PostController::class)->group(function () {
Route::name('posts.')
    ->prefix('posts')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->whereNumber('id')->name('show');
        Route::get('/create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::get('/{id}/edit', 'edit')->name('edit');
        Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
        Route::get('/download', 'download')->name('download');
    }
);});
Route::middleware(['test.pre', 'test.post'])->name('categories.')
    ->prefix('categories')
    ->group(function () {
        Route::get('/', [CategoryPostController::class, 'index'])->name('index');
        Route::get('/{category}', [CategoryPostController::class, 'show'])->name('show')->withoutMiddleware(['test.pre', 'test.post']);
    }
);
//TODO внесите в группу posts
// Route::get('/posts/categories', [CategoryPostController::class, 'index'])->name('posts.categories.index');
// Route::get('/posts/categories/{category}', [CategoryPostController::class, 'show'])->name('posts.categories.show');


// TODO: GET + PUT (Обновление поста) (@method('PUT') внутри формы blade при обновлении)
// TODO: DELETE (Удаление поста) (/post/{id})
