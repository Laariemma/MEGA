<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\ClosedTicket;

class ClosedTicketController extends Controller
{
    // Sulje tiketti
    public function closeTicket($id)
    {
        $feedback = Feedback::findOrFail($id);

        // Lisätään suljettuun tauluun
        ClosedTicket::create([
            'feedback_id' => $feedback->id,
        ]);

        // Palautetaan takaisin ja näytetään viesti
        return redirect()->back()->with('status', 'Tiketti suljettu!');
    }

    // Näytä suljetut tiketit työntekijälle

public function showClosedTickets()
{
    $closedTickets = ClosedTicket::with('feedback')->orderBy('created_at', 'desc')->get();
    return view('employee.dashboard', compact('closedTickets'));
}
}
