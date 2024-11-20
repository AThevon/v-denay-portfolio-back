<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
  public function run()
  {
    Category::insert([
      ['title' => 'Musique', 'image' => 'https://v-denay-portfolio.s3.eu-west-3.amazonaws.com/categories/music.jpg', 'icon' => 'AudioLines'],
      ['title' => 'Corporate', 'image' => 'https://v-denay-portfolio.s3.eu-west-3.amazonaws.com/categories/corpo.jpg', 'icon' => 'Briefcase'],
      ['title' => 'Fiction', 'image' => 'https://v-denay-portfolio.s3.eu-west-3.amazonaws.com/categories/fiction.jpg', 'icon' => 'Film'],
    ]);
  }
}
