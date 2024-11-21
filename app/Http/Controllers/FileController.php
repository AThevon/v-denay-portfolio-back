<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
  /**
   * Affiche les options de gestion des fichiers (CV, photo de profil).
   */
  public function index()
  {
    $cvUrl = Storage::disk('s3')->url('misc/cv.pdf');
    $profilePictureUrl = Storage::disk('s3')->url('misc/profile_picture.jpg');

    return view('files.index', compact('cvUrl', 'profilePictureUrl'));
  }

  /**
   * Upload ou remplace le CV.
   */
  public function uploadCV(Request $request)
  {
    $request->validate([
      'cv' => 'required|mimes:pdf|max:10240', // Max 10 Mo
    ]);

    // Supprimer l'ancien fichier s'il existe
    Storage::disk('s3')->delete('cv.pdf');

    // Upload du nouveau fichier avec le nom 'cv.pdf'
    $path = $request->file('cv')->storeAs('misc', 'cv.pdf', 's3');

    return redirect()->back()->with('success', 'CV mis à jour avec succès !');
  }

  /**
   * Upload ou remplace la photo de profil.
   */
  public function uploadProfilePicture(Request $request)
  {
    $request->validate([
      'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:10240',
    ]);

    // Supprimer l'ancienne photo de profil
    Storage::disk('s3')->delete('profile_picture.jpg');

    // Upload de la nouvelle photo de profil avec un nom fixe
    $path = $request->file('profile_picture')->storeAs('misc', 'profile_picture.jpg', 's3');

    return redirect()->back()->with('success', 'Photo de profil mise à jour avec succès !');
  }
}