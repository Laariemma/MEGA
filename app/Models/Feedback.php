<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['aihe', 'palaute', 'email', 'status'];

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

   

}
