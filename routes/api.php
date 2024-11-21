<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectController;

// Route pour récupérer toutes les catégories avec leurs images
Route::get('/categories', [CategoryController::class, 'getAllCategories']);

// Route pour récupérer les projets par catégorie
Route::get('/projects/{category}', [ProjectController::class, 'getProjectsByCategory']);