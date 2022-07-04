<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

Route::resource('tag', TagController::class);


