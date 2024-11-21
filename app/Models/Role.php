<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;

  protected $fillable = ['name'];

  protected $hidden = ['created_at', 'updated_at', 'pivot'];

  public function projects()
  {
    return $this->belongsToMany(Project::class, 'project_role');
  }
}