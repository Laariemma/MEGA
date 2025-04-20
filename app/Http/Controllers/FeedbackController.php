<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\ClosedTicket;
use App\Models\Suggestion;

class FeedbackController extends Controller
{
    public function showDashboard()
    {
        // Haetaan kaikki avoimet tiketit, joilla ei ole suljettu status
        $feedbacks = Feedback::with(['comments.user'])->where('status', 'open')->get();
    
        // Haetaan kaikki suljetut tiketit ja niiden palautteet
        $closedTickets = ClosedTicket::with('feedback')->get();
    
        // Haetaan kaikki suggestion-tiketit , jotka on lähetetty adminille
        $suggestions = Suggestion::with('feedback.comments')->get();

        // Haetaan kaikki vastatut tiketit
        $answeredTickets = Feedback::with('comments.user')->where('status', 'answered')->get();
    
        // Lähetetään kaikki tiedot näkymään
        return view('employee.dashboard', compact('feedbacks', 'closedTickets', 'suggestions', 'answeredTickets'));
    }

    public function store(Request $request)
    {
        // Validointi
        $validated = $request->validate([
            'aihe' => 'required|string|max:255',
            'palaute' => 'required|string',
            'email' => 'required|email',
        ]);

        // Uuden palautteen luonti
        $feedback = new Feedback;
        $feedback->aihe = $validated['aihe'];
        $feedback->palaute = $validated['palaute'];
        $feedback->email = $validated['email'];
        $feedback->status = 'open'; 
        $feedback->save();

        return redirect('/')->with('success', 'Palaute tallennettu onnistuneesti!');
    }

    public function index()
    {
        // Haetaan kaikki palautteet 
        $feedbacks = Feedback::with(['comments.user', 'comments.replies.user'])->get();

        if (auth()->check() && auth()->user()->role === 'employee') {
            return view('employee.dashboard', compact('feedbacks'));
        } elseif (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.dashboard', compact('feedbacks'));
        }

        return view('welcome', compact('feedbacks'));
    }

    public function pushToAdminAsSuggestion($id)
    {
        // Etsi palautteen ID
        $feedback = Feedback::findOrFail($id);
    
        // Siirretään tiketti suggestions-tauluun
        Suggestion::create([
            'feedback_id' => $feedback->id,
        ]);
    
        // Merkitään tiketti ehdotukseksi (adminille)
        $feedback->status = 'suggested';  // Aseta status suggested eikä open
        $feedback->save();
    
        // Palautetaan viesti käyttäjälle
        return redirect()->back()->with('status', 'Palaute lähetetty adminille ehdotuksena!');
    }
}