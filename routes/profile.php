<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Route::resource('profile', ProfileController::class);

Route::get('profile', [ProfileController::class, 'index'])->middleware(['auth'])->name('profile.index');
Route::get('profile/edit/{id}', [ProfileController::class, 'edit'])->middleware(['auth'])->name('profile.edit');
Route::patch('profile/{id}', [ProfileController::class, 'update'])->middleware(['auth'])->name('profile.update');
