<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProjectTest extends TestCase
{
  use RefreshDatabase; // Pour recréer la base de données à chaque test

  /** @test */
  public function it_validates_project_creation()
  {
    $this->withoutExceptionHandling();
    $this->actingAs(User::factory()->create());

    try {
      $response = $this->post(route('projects.store'), [
        'title' => '', // Titre manquant
        'category_id' => 999, // Catégorie inexistante
        'image' => null, // Image manquante
      ]);
    } catch (\Illuminate\Validation\ValidationException $e) {
      $this->assertArrayHasKey('title', $e->errors());
      $this->assertArrayHasKey('category_id', $e->errors());
      $this->assertArrayHasKey('image', $e->errors());
      return;
    }

    $this->fail('La validation n’a pas levé d’exception alors qu’elle aurait dû.');
  }




  /** @test */
  public function it_creates_a_project_successfully()
  {
    // Simuler un utilisateur authentifié
    $user = User::factory()->create();
    $this->actingAs($user);

    // Simuler une catégorie existante
    $category = Category::factory()->create();

    // Simuler un stockage fake
    Storage::fake('s3');

    $response = $this->post(route('projects.store'), [
      'title' => 'Nouveau Projet',
      'category_id' => $category->id,
      'image' => UploadedFile::fake()->image('project.jpg'),
      'url' => 'https://youtube.com/example',
      'date' => '2025-01-01',
      'client' => 'Client Exemple',
      'roles' => [], // Ajoute les rôles si nécessaire
    ]);

    $response->assertRedirect(route('projects.index'));
    $this->assertDatabaseHas('projects', ['title' => 'Nouveau Projet']);
  }

  /** @test */
  public function it_denies_access_to_unauthenticated_users()
  {
    $response = $this->post(route('projects.store'), []);
    $response->assertRedirect(route('login'));
  }
}
