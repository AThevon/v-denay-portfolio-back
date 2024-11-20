<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
  // Liste tous les rôles
  public function index()
  {
    $roles = Role::all();
    return view('roles.index', compact('roles'));
  }

  // Affiche le formulaire pour créer un rôle
  public function create()
  {
    return view('roles.create');
  }

  // Sauvegarde un nouveau rôle
  public function store(Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255|unique:roles',
    ]);

    Role::create($validated);

    return redirect()->route('roles.index')->with('success', 'Rôle ajouté.');
  }

  // Affiche un rôle spécifique
  public function show(Role $role)
  {
    //
  }

  // Affiche le formulaire pour modifier un rôle
  public function edit(Role $role)
  {
    return view('roles.edit', compact('role'));
  }

  // Met à jour un rôle existant
  public function update(Request $request, Role $role)
  {
    $validated = $request->validate([
      'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
    ]);

    $role->update($validated);

    return redirect()->route('roles.index')->with('success', 'Rôle mis à jour.');
  }

  // Supprime un rôle
  public function destroy(Role $role)
  {
    $role->delete();
    return redirect()->route('roles.index')->with('success', 'Rôle supprimé.');
  }
}