<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinkSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $socialLinks = [
      [
        'platform' => 'instagram',
        'url' => 'https://www.instagram.com/nitro_vision?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==',
        'description' => 'Suivez-moi sur Instagram',
      ],
      [
        'platform' => 'linkedin',
        'url' => 'https://www.linkedin.com/in/victor-denay-844889256/',
        'description' => 'Rejoignez-moi sur LinkedIn',
      ],
    ];

    foreach ($socialLinks as $link) {
      SocialLink::updateOrCreate(
        ['platform' => $link['platform']], // Condition : la plateforme doit être unique
        ['url' => $link['url'], 'description' => $link['description']] // Mise à jour ou création
      );
    }
  }
}
