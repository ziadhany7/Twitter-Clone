<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','is_banned'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/users',[AdminController::class, 'index'])->name('admin.show.users')->middleware(['auth','isAdmin']);

Route::put('/users/{user}/block',[AdminController::class,'block'])->name("users.block")->middleware(['auth','isAdmin']);
Route::put('/users/{user}/unblock',[AdminController::class,'unblock'])->name("users.unblock")->middleware(['auth','isAdmin']);

Route::resource('chirps', ChirpController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

// Route::get('/chirps',[ChirpController::class,'index'])->middleware(['auth', 'verified'])->name(name:'chirps.index');
// Route::post('/chirps',[ChirpController::class,'store'])->middleware(['auth', 'verified'])->name(name:'chirps.store');
require __DIR__ . '/auth.php';
