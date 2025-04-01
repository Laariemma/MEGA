<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    use HasFactory;

    protected $table = 'answers'; // Taulun nimi

    protected $fillable = ['feedback_id', 'user_id', 'answer'];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

