<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\Feedback;

class AnswerController extends Controller
{
    public function store(Request $request, $feedback_id)
{
    $request->validate([
        'answers' => 'required|string',
    ]);

    $answer = new Answers();  // Käytä 'Answer' ja ei 'Answers'
    $answer->feedback_id = $feedback_id;
    $answer->user_id = auth()->user()->id;
    $answer->answer = $request->answers;  // Käytä oikein kentän nimeä
    $answer->save();

    return redirect()->back()->with('success', 'Vastaus tallennettu onnistuneesti.');
}

}
