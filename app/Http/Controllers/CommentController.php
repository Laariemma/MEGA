<?php
namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller {
    public function store(Request $request, $id) {
        $request->validate([
            'comment' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id' // Jos kommentti on vastaus toiseen kommenttiin
        ]);

        Comment::create([
            'feedback_id' => $id,
            'user_id' => auth()->id(), // Tallennetaan nykyinen käyttäjä (työntekijä tai admin)
            'comment' => $request->comment,
            'parent_id' => $request->parent_id
        ]);

        return back();
    }
}