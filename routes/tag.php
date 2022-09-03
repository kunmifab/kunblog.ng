<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::resource('tag', TagController::class);

Route::get('tag', [TagController::class, 'index'])->name('tag.index');
Route::get('tag/create', [TagController::class, 'create'])->name('tag.create');
Route::post('tag', [TagController::class, 'store'])->name('tag.store');
Route::get('tag/{slug}', [TagController::class, 'show'])->name('tag.show');


