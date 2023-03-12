<?php

use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('layouts.master');
})->name('welcome');

Route::group([
    'as' => 'users.',
    'prefix' => 'users',
], function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
})->middleware('AdminMiddleware');
Route::group([
    'as' => 'posts.',
    'prefix' => 'posts',
], function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/store', [PostController::class, 'store'])->name('store');

    Route::get('/{post}', [PostController::class, 'edit'])->name('edit');

    Route::put('/{post}', [PostController::class, 'update'])->name('update');

    Route::get('/change_status/{post}', [PostController::class, 'editPostStatus'])->name('editPostStatus');

    Route::delete('/{id}', [PostController::class, 'destroy'])->name('destroy');

})->middleware('AdminMiddleware');
