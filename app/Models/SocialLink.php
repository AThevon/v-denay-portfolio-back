<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
  protected $fillable = ['platform', 'url', 'description'];

  protected $hidden = ['created_at', 'updated_at'];
}
