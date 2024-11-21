<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SocialLinkController;

Route::get('/categories', [CategoryController::class, 'getAllCategories']);

Route::get('/projects/{category}', [ProjectController::class, 'getProjectsByCategory']);

Route::get('/social-links', [SocialLinkController::class, 'getSocialLinks']);