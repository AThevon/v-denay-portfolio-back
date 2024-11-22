<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  public function up()
  {
    Schema::table('projects', function (Blueprint $table) {
      // Ajout de la colonne 'featured'
      $table->boolean('featured')->default(false)->after('client');
    });

  }

  public function down()
  {
    Schema::table('projects', function (Blueprint $table) {
      // Suppression de la colonne 'featured'
      $table->dropColumn('featured');
    });
  }
};