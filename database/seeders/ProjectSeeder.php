<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Category;
use App\Models\Role;

class ProjectSeeder extends Seeder
{
  public function run()
  {
    // Charger le JSON
    $data = json_decode(file_get_contents(database_path('seeders/data/projects.json')), true);

    foreach ($data as $item) {
      // Trouver ou créer la catégorie
      $category = Category::firstOrCreate(
        ['title' => $item['category']],
        ['image' => null] // Valeurs par défaut si la catégorie est créée
      );

      // Trouver ou créer le projet
      $project = Project::updateOrCreate(
        ['title' => $item['title']], // Critère pour identifier un projet unique
        [
          'category_id' => $category->id,
          'image' => $item['image'],
          'url' => $item['url'],
          'date' => $item['date'],
          'client' => $item['client'],
        ]
      );

      // Gérer les rôles
      $roleIds = [];
      foreach ($item['roles'] as $roleName) {
        // Trouver ou créer chaque rôle
        $role = Role::firstOrCreate(['name' => $roleName]);
        $roleIds[] = $role->id;
      }

      // Synchroniser les rôles avec le projet (évite les doublons dans la table pivot)
      $project->roles()->sync($roleIds);
    }
  }
}