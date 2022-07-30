<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'obstacle_id', 'solution_id', 'body'];

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

    // back-track to the solution
    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
