<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    User::firstOrCreate(
      ['email' => 'denayvic@gmail.com'],
      [
        'name' => 'Victor Denay',
        'password' => Hash::make('admin123'),
      ]
    );
  }
}
