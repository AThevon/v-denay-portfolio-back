<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'category_id', 'image', 'url', 'date', 'client', 'featured'];

  protected $casts = [
    'date' => 'datetime',
  ];

  protected $hidden = ['created_at', 'updated_at', 'category_id'];

  protected $appends = ['roles_list'];

  public function category()
  {
    return $this->belongsTo(Category::class);
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class, 'project_role');
  }

  // Accessor pour les rôles sous forme de tableau
  protected function getRolesListAttribute()
  {
    return $this->roles->pluck('name')->toArray();
  }
}