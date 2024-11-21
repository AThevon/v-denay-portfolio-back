<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
  public function run()
  {
    $categories = [
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
    ];

    foreach ($categories as $category) {
      Category::updateOrCreate(
        ['title' => $category['title']],
        ['image' => $category['image']]
      );
    }
  }
}