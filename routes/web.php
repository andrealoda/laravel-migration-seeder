<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController as PageController;

Route::get('/', [PageController::class, 'index'])->name('index');
