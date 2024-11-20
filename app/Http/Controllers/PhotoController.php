<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoController extends Controller
{
  public function index()
  {
    return view('photos.index');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'photo' => 'required|image|mimes:jpg,png,jpeg|max:8000',
      'theme' => 'required|string|in:illusions-perdues,photos-color,portraits',
    ]);

    try {
      $theme = $validated['theme'];
      $path = $request->file('photo')->store("photos/{$theme}", 's3');

      return redirect()->route('photos.index')->with('success', 'Photo uploadée avec succès.');
    } catch (\Exception $e) {
      return redirect()->route('photos.index')->with('error', 'Une erreur s\'est produite lors de l\'upload de la photo.');
    }
  }
}
