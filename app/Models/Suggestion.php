<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;


    protected $fillable = [
        'feedback_id',
        
    ];
    
    
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
