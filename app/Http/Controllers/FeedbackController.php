<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Category;

class FeedbackController extends Controller
{

    public function showDashboard()
    {
        
        $feedbacks = Feedback::all(); // Hakee kaikki palautteet ja lähettää ne näkyville
        
        
        return view('employee.dashboard', compact('feedbacks'));// Tuo palautteet sinne "employee/dashboard" sivulle
    }

    public function store(Request $request)
    {
        // 
        $validated = $request->validate([           //vaihettu validate termi, että tuo vain noi tietyt tiedot 
            'aihe' => 'required|string|max:255',
            'palaute' => 'required|string',
            'email' => 'required|email',
        ]);

    
    
        $feedback = new Feedback;
        $feedback->aihe = $validated['aihe'];       //eli validated vaihtu tähän niin saa tarvitut tiedot
        $feedback->palaute = $validated['palaute']; 
        $feedback->email = $validated['email']; 
        $feedback->save();

        return redirect('/')->with('success', 'Palaute tallennettu onnistuneesti!'); 
    }
    
    public function index()
    {
        $feedbacks = Feedback::all();
        return view('welcome', compact('feedbacks'));
    }
}
