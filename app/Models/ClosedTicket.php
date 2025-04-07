<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClosedTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_id',
    ];

    // Suhde palautteeseen
    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}