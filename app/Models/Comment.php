<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;
    protected $fillable = ['feedback_id', 'user_id', 'comment', 'parent_id'];

    public function feedback() {
        return $this->belongsTo(Feedback::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasOne(Comment::class, 'parent_id');
    }
}