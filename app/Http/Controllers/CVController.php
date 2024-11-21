<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CVController extends Controller
{
  public function index()
  {
    return view('cv.index');
  }

  public function uploadCV(Request $request)
  {
    // Valider le fichier uploadé
    $request->validate([
      'cv' => 'required|mimes:pdf|max:10240', // Max 10 Mo
    ]);

    // Supprime l'ancien fichier s'il existe
    Storage::disk('s3')->delete('cv.pdf');

    // Upload du nouveau fichier avec le nom 'cv.pdf'
    $path = $request->file('cv')->storeAs('', 'cv.pdf', 's3');

    return redirect()->back()->with('success', 'CV mis à jour avec succès !');
  }
}