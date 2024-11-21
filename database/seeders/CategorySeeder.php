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
        'image' => 'https://v-denay-portfolio.s3.eu-west-3.amazonaws.com/categories/music.jpg',
      ],
      [
        'title' => 'corporate',
        'image' => 'https://v-denay-portfolio.s3.eu-west-3.amazonaws.com/categories/corpo.jpg',
      ],
      [
        'title' => 'fiction',
        'image' => 'https://v-denay-portfolio.s3.eu-west-3.amazonaws.com/categories/fiction.jpg',
      ],
    ]);
  }
}
