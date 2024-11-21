<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
  public function run()
  {
    Category::insert([
      [
        'title' => 'musique',
        'image' => env('AWS_BUCKET_LINK') . '/categories/music.jpg',
      ],
      [
        'title' => 'corporate',
        'image' => env('AWS_BUCKET_LINK') . '/categories/corpo.jpg',
      ],
      [
        'title' => 'fiction',
        'image' => env('AWS_BUCKET_LINK') . '/categories/fiction.jpg',
      ],
    ]);
  }
}
