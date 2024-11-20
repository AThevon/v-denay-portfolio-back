<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;

Route::get('/', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])
    ->name('profile.destroy');

  Route::resource('/projects', ProjectController::class)
    ->except(['show']);
  Route::resource('/roles', RoleController::class)
    ->except(['show']);
  Route::resource('/categories', CategoryController::class)
    ->except(['show', 'create', 'destroy']);

  Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
  Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
});

require __DIR__ . '/auth.php';
