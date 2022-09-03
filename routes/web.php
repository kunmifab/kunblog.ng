<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TextSearchController;
use Illuminate\Support\Facades\Route;


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
    return view('index');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/search', [PostController::class, 'search'])->name('search');
Route::post('comment', [CommentController::class, 'store'])->name('comment.store');

Route::get('notifications', [NotificationController::class, 'index'])->middleware(['auth'])->name('notification.index');

require __DIR__.'/auth.php';
require __DIR__.'/tag.php';
require __DIR__.'/post.php';
require __DIR__.'/profile.php';
require __DIR__.'/category.php';
require __DIR__.'/role.php';
require __DIR__.'/user.php';
