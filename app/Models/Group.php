<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    // public function owner()
    // {
    //     return $this->belongsTo(User::class, 'user_id'); // Group creator (owner)
    // }

    // public function members()
    // {
    //     return $this->belongsToMany(User::class); // Many-to-many relationship
    // }

    // public function posts()
    // {
    //     return $this->hasMany(Post::class); // If group-specific posts are needed
    // }
}
