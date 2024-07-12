<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'bio', 'location', 'birthdate', 'profile_pic', 'wallpaper'];

    public function user()
    {
        return $this->belongsTo(User::class); // Each record belongs to a user
    }
}
