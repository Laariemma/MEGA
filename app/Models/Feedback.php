<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback'; 
    protected $fillable = ['aihe', 'palaute', 'email'];


public function category()
{
    return $this->hasOne(Category::class); //yhdellä palautteella on yksi kategoria, toimii ehkä "hasMany" myös??
}
}