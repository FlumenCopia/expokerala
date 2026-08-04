<?php

use App\Http\Controllers\pageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', [pageController::class, 'index'])->name('index');
Route::get('/exhibitors-register', [pageController::class, 'exhibitorsRegister']);
Route::get('/visitor-registration', [pageController::class, 'visitorsRegister']);
Route::post('/visitors-register', [pageController::class, 'saveVisitorsRegister']);
Route::post('/exhibitors-register', [pageController::class, 'saveExhibitorsRegister']);
Route::get('/badge', [pageController::class, 'badgeSuccess']);
Route::post('/exhibitors-register', [pageController::class, 'saveExhibitorsRegister']);
Route::get('sub-event-register/{slug}', [pageController::class, 'subEventRegister']);
Route::post('sub-event-register/{slug}', [pageController::class, 'saveSubEventRegister']);
require __DIR__.'/auth.php';
