<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'obstacle_id', 'body', 'complete'];

    // back-track to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // back-track to obstacle
    public function obstacle()
    {
        return $this->belongsTo(Obstacle::class);
    }

    // resolutions
    public function resolutions(){
        return $this->hasMany(Resolution::class);
    }
}
