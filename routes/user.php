<?php


use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\user\UserHomeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'posts.',
    'prefix' => 'posts',
], function () {
    Route::get('/', [UserHomeController::class, 'index'])->name('index');
    Route::get('/create', [UserHomeController::class, 'create'])->name('create');
    Route::post('/store', [UserHomeController::class, 'store'])->name('store');
    Route::get('/{post}', [UserHomeController::class, 'edit'])->name('edit');
    Route::put('/{post}', [UserHomeController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserHomeController::class, 'destroy'])->name('destroy');

});
