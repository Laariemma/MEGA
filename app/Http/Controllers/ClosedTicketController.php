<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\ClosedTicket;

class ClosedTicketController extends Controller
{

    public function closeTicket($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->status = 'closed';
        $feedback->save();
        
        $alreadyClosed = ClosedTicket::where('feedback_id', $feedback->id)->exists();

        if (!$alreadyClosed) {
            ClosedTicket::create([
                'feedback_id' => $feedback->id,
            ]);
        }

        return redirect()->route('dashboard')->with('status', 'Tiketti suljettu!');
    }
}