<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $feedback = new Feedback;
        $feedback->aihe = $request->aihe;
        $feedback->palaute = $request->palaute;
        $feedback->save();

        return redirect('/')->with('success', 'Palaute tallennettu onnistuneesti!');
    }
}
