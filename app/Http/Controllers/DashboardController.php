<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; 
use App\Models\Suggestion;

class DashboardController extends Controller
{
    public function index()
    {
        // Haetaan ehdotukset adminille
        $suggestions = Suggestion::with('feedback.comments')->get();

        // Haetaan vastatut tiketit
        $answeredTickets = Feedback::where('status', 'answered')
            ->with(['comments', 'answers.employee']) //employeen vastaus asiakkaalle
            ->get();

        return view('admin.dashboard', compact('suggestions', 'answeredTickets'));
    }

    

}