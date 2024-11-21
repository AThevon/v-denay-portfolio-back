<?php

namespace App\Http\Controllers;

use App\Models\SocialLink;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
  public function getSocialLinks()
  {
    return response()->json(SocialLink::all());
  }
  public function index()
  {
    $socialLinks = SocialLink::all();
    return view('dashboard.social-links', compact('socialLinks'));
  }

  public function update(Request $request)
  {
    $validated = $request->validate([
      'social_links' => 'required|array',
      'social_links.*.platform' => 'required|string',
      'social_links.*.url' => 'required|url',
      'social_links.*.description' => 'required|string',
    ]);

    foreach ($validated['social_links'] as $link) {
      SocialLink::updateOrCreate(
        ['platform' => $link['platform']],
        ['url' => $link['url'], 'description' => $link['description']]
      );
    }

    return redirect()->back()->with('success', 'Liens mis à jour avec succès !');
  }

  public function destroy(SocialLink $socialLink)
  {
    $socialLink->delete();

    return redirect()->back()->with('success', 'Lien supprimé avec succès !');
  }
}