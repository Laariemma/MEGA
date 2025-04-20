<?php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feedback;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $id)
    {
        // Etsi palaute tiketti
        $feedback = Feedback::findOrFail($id);

        // Validointi
        $request->validate([
            'comment' => 'required|string',  // Varmistaa, että kommentti on annettu
            'parent_id' => 'nullable|exists:comments,id' // Jos kommentti on vastaus toiseen kommenttiin
        ]);

        // Luo uusi kommentti
        Comment::create([
            'feedback_id' => $id,
            'user_id' => auth()->id(), // Tallennetaan kirjautuneen käyttäjän ID
            'comment' => $request->comment, // Kommentti
            'parent_id' => $request->parent_id // Jos on alikommentti
        ]);

        return back()->with('status', 'Kommentti lisätty!');
    }
}