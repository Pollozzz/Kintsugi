<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'welcome'])->name('welcome');

Route::get('/advertisements/create', [AdvertisementController::class, 'create'])->name('advertisement.create');
Route::get('/advertisements/index', [AdvertisementController::class, 'index'])->name('advertisement.index');
Route::get('/advertisements/show/{advertisement}', [AdvertisementController::class, 'show'])->name('advertisement.show');

Route::get('/category/show/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Revisor
Route::middleware(['isRevisor'])->group(function () {
    Route::get('/revisor/index', [RevisorController::class, 'index'])->name('revisor.index');
    Route::patch('/accept/{advertisement}', [RevisorController::class, 'accept'])->name('accept');
    Route::patch('/reject/{advertisement}', [RevisorController::class, 'reject'])->name('reject');
    Route::patch('/revision/{advertisement}', [RevisorController::class, 'revision'])->name('revision');
    Route::get('/revisor/show/{advertisement}', [RevisorController::class, 'show'])->name('revisor.show');
});

Route::get('/revisor/request', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('become.revisor');
Route::get('/make/revisor/{user}', [RevisorController::class, 'confirmMakeRevisor'])
    ->middleware(['auth', 'isRevisor', 'signed'])
    ->name('make.revisor.confirm');

Route::post('/make/revisor/{user}', [RevisorController::class, 'makeRevisor'])
    ->middleware(['auth', 'isRevisor', 'signed'])
    ->name('make.revisor');

Route::get('/search/advertisement', [PublicController::class, 'searchAdvertisements'])->name('advertisement.search');

// rotta lingua
Route::post('/lingua/{lang}', [PublicController::class, 'setLanguage'])->name('setLocale');
