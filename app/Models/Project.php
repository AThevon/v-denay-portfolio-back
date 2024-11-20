<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'category_id', 'image', 'url', 'date', 'client'];

  protected $casts = [
    'date' => 'datetime',
  ];
  
  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class, 'project_role');
  }
}