<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Middleware\IsAdmin;

Route::get('/', [FaqController::class, 'index'])->name('faq.index');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', fn() => Inertia::render('Admin/Dashboard'))->name('admin.dashboard');
        Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
        Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
        Route::post('faqs/{faq}/move-up', [\App\Http\Controllers\Admin\FaqController::class, 'moveUp'])->name('faqs.moveUp');
        Route::post('faqs/{faq}/move-down', [\App\Http\Controllers\Admin\FaqController::class, 'moveDown'])->name('faqs.moveDown');
    });
