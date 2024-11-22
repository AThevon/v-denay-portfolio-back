<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
  public function getProjectsByCategory($category)
  {
    $categoryModel = Category::where('title', $category)->first();

    if (!$categoryModel) {
      return response()->json(['error' => 'Category not found'], 404);
    }

    // Récupération paginée des projets
    $projects = Project::with(['category', 'roles'])
      ->where('category_id', $categoryModel->id)
      ->orderBy('date', 'desc')
      ->paginate(5);

    // Retourne les projets en JSON (les accessors et relations sont automatiquement inclus)
    return response()->json($projects);
  }

  public function getFeaturedProject()
  {
    // Récupère le projet mis en avant avec les relations
    $featuredProject = Project::with(['category'])->where('featured', true)->first();

    if ($featuredProject) {
      return response()->json($featuredProject);
    } else {
      return response()->json([
        'error' => 'No featured project found.',
      ], 404);
    }
  }

  public function feature(Project $project)
  {
    // Désactiver la mise en avant pour tous les autres projets
    Project::where('featured', true)->update(['featured' => false]);

    // Activer la mise en avant pour le projet sélectionné
    $project->update(['featured' => true]);

    return redirect()->back()->with('success', 'Le projet a été mis en avant avec succès.');
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    // Récupère tous les projets avec leurs catégories et rôles
    $projects = Project::with(['category', 'roles'])
      ->orderBy('featured', 'desc') // Projets en avant d'abord
      ->orderBy('created_at', 'desc') // Puis trie par date de création
      ->paginate(9); // Pagination
    return view('projects.index', compact('projects'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    // Récupère les catégories et les rôles pour les afficher dans le formulaire
    $categories = Category::all();
    $roles = Role::all();
    return view('projects.create', compact('categories', 'roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'category_id' => 'required|exists:categories,id',
      'image' => 'required|image|mimes:jpg,png,jpeg|max:10240',
      'url' => 'nullable|url',
      'date' => 'nullable|date',
      'client' => 'nullable|string|max:255',
      'roles' => 'nullable|array',
    ]);

    // Upload l'image sur S3
    $imagePath = $request->file('image')->store('projects', 's3');

    // Créer le projet
    $project = Project::create([
      'title' => $validated['title'],
      'category_id' => $validated['category_id'],
      'image' => Storage::disk('s3')->url($imagePath),
      'url' => $validated['url'],
      'date' => $validated['date'],
      'client' => $validated['client'],
    ]);

    // Associer les rôles
    if ($request->roles) {
      $project->roles()->sync($validated['roles']);
    }

    return redirect()->route('projects.index')->with('success', 'Projet ajouté.');
  }

  /**
   * Display the specified resource.
   */
  public function show(Project $project)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Project $project)
  {
    // Récupère les catégories et les rôles pour les afficher dans le formulaire
    $categories = Category::all();
    $roles = Role::all();
    return view('projects.edit', compact('project', 'categories', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Project $project)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'category_id' => 'required|exists:categories,id',
      'image' => 'nullable|image|mimes:jpg,png,jpeg|max:8000',
      'url' => 'nullable|url',
      'date' => 'nullable|date',
      'client' => 'nullable|string|max:255',
      'roles' => 'nullable|array',
    ]);

    // Mettre à jour les champs du projet
    $project->update($validated);

    // Gérer l'image
    if ($request->hasFile('image')) {
      // Supprimer l'ancienne image de S3
      if ($project->image) {
        $oldImagePath = parse_url($project->image, PHP_URL_PATH);
        Storage::disk('s3')->delete(ltrim($oldImagePath, '/'));
      }

      // Upload la nouvelle image
      $imagePath = $request->file('image')->store('projects', 's3');
      $project->image = Storage::disk('s3')->url($imagePath);
      $project->save();
    }

    // Mettre à jour les rôles
    if ($request->roles) {
      $project->roles()->sync($validated['roles']);
    }

    return redirect()->route('projects.index')->with('success', 'Projet mis à jour.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Project $project)
  {
    // Supprime l'image de S3
    if ($project->image) {
      $imagePath = parse_url($project->image, PHP_URL_PATH);
      Storage::disk('s3')->delete(ltrim($imagePath, '/'));
    }

    // Supprime le projet
    $project->delete();

    return redirect()->route('projects.index')->with('success', 'Projet supprimé.');
  }
}