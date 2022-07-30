<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obstacle extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'body', 'complete'];

    // back-track to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // solutions to obstacles
    public function solutions(){
        return $this->hasMany(Solution::class);
    }

    // resolutions
    public function resolutions(){
        return $this->hasMany(Resolution::class);
    }
}
