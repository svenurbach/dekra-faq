<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;

Route::get('/', [FaqController::class, 'index'])->name('faq.index');
