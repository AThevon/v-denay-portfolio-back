<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

  public function getAllCategories()
  {
    // Récupère toutes les catégories avec leurs images
    $categories = Category::select('id', 'title', 'image')->get();

    return response()->json($categories);
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $categories = Category::all();
    return view('categories.index', compact('categories'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Category $category)
  {
    return view('categories.edit', compact('category'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Category $category)
  {
    $validated = $request->validate([
      'title' => 'required|string|max:255',
      'image' => 'nullable|image|mimes:jpg,png,jpeg|max:8000',
    ]);

    if ($request->hasFile('image')) {
      if ($category->image) {
        $oldImagePath = parse_url($category->image, PHP_URL_PATH);
        Storage::disk('s3')->delete(ltrim($oldImagePath, '/'));
      }

      $imagePath = $request->file('image')->store('categories', 's3');
      $category->image = Storage::disk('s3')->url($imagePath);
    }

    $category->title = $validated['title'];
    $category->save();

    return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Category $category)
  {
    //
  }
}