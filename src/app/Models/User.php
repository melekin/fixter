<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'session_code'];

    // user obstacles
    public function obstacles($id = null)
    {
        return $this->hasMany(Obstacle::class);
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
