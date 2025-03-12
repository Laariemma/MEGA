<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'feedback_id'];


    public function feedback()
    {
        return $this->belongsTo(Feedback::class); 
    }
}