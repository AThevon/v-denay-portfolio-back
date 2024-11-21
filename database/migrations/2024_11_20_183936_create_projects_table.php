<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    // Création de la table categories
    Schema::create('categories', function (Blueprint $table) {
      $table->id();
      $table->string('title'); // Ex: 'musique'
      $table->string('image')->nullable(); // Ex: 'music.jpg'
      $table->timestamps();
    });

    // Création de la table projects
    Schema::create('projects', function (Blueprint $table) {
      $table->id();
      $table->string('title'); // Titre du projet
      $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Lien vers la catégorie
      $table->string('image')->nullable(); // Lien vers l'image
      $table->string('url')->nullable(); // Lien vers la vidéo ou page externe
      $table->date('date')->nullable(); // Date du projet
      $table->string('client')->nullable(); // Nom du client
      $table->timestamps();
    });

    // Création de la table roles
    Schema::create('roles', function (Blueprint $table) {
      $table->id();
      $table->string('name'); // Nom du rôle, ex: "Réalisateur"
      $table->timestamps();
    });

    // Table pivot pour relier projects et roles (relation many-to-many)
    Schema::create('project_role', function (Blueprint $table) {
      $table->id();
      $table->foreignId('project_id')->constrained()->onDelete('cascade');
      $table->foreignId('role_id')->constrained()->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('project_role'); // Supprime la table pivot en premier
    Schema::dropIfExists('roles');       // Supprime ensuite la table roles
    Schema::dropIfExists('projects');   // Supprime la table projects
    Schema::dropIfExists('categories'); // Supprime la table categories
  }
};