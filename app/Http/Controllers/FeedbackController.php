<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Category;
use App\Models\ClosedTicket;

class FeedbackController extends Controller
{
    public function showDashboard()
    {
        // Hakee kaikki avoimet tiketit
        $feedbacks = Feedback::where('status', 'open')->get(); // Avoimet tiketit

        // Hakee kaikki suljetut tiketit
        $closedTickets = ClosedTicket::with('feedback')->get(); // Suljetut tiketit ja niiden palautteet

        return view('employee.dashboard', compact('feedbacks', 'closedTickets')); // Lähetetään molemmat muuttujat näkymään
    }
    
    public function store(Request $request)
    {
        // Validointi
        $validated = $request->validate([
            'aihe' => 'required|string|max:255',
            'palaute' => 'required|string',
            'email' => 'required|email',
        ]);

        // Uuden palautteen luominen
        $feedback = new Feedback;
        $feedback->aihe = $validated['aihe'];
        $feedback->palaute = $validated['palaute'];
        $feedback->email = $validated['email'];
        $feedback->save();

        return redirect('/')->with('success', 'Palaute tallennettu onnistuneesti!');
    }
    
    public function index()
{
    $feedbacks = Feedback::with(['comments.user', 'comments.replies.user'])->get(); // Ladataan palautteet ja kommentit

    if (auth()->check() && auth()->user()->role === 'employee') {
        return view('employee.dashboard', compact('feedbacks')); // Työntekijälle
    } elseif (auth()->check() && auth()->user()->role === 'admin') {
        return view('admin.dashboard', compact('feedbacks')); // Adminille
    }

    return view('welcome', compact('feedbacks')); // Asiakkaalle
}
}
