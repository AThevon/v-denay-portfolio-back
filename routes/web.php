<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SocialLinkController;
use App\Models\SocialLink;

Route::get('/', function () {
  $bucketUrl = env('AWS_BUCKET_LINK');
  $socialLinks = SocialLink::all();

  return view('dashboard', compact('bucketUrl', 'socialLinks'));
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

  Route::get('/files', [FileController::class, 'index'])->name('files.index');
  Route::post('/files/upload-cv', [FileController::class, 'uploadCV'])->name('files.uploadCV');
  Route::post('/files/upload-profile-picture', [FileController::class, 'uploadProfilePicture'])->name('files.uploadProfilePicture');
  Route::get('/social-links', [SocialLinkController::class, 'index'])->name('social-links.index');
  Route::post('/social-links', [SocialLinkController::class, 'update'])->name('social-links.update');
});

require __DIR__ . '/auth.php';
