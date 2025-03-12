<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::doesntHave('category')->get(); 
        return view('employee.dashboard', compact('feedbacks')); //Näyttää palautteet nyt siellä employee sivulla
    }

    public function assign(Request $request, $feedback_id)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
        ]);

        
        $feedback = Feedback::findOrFail($feedback_id); // Hakee palautteen, johon se kategoria liitetään

        // Luo uuden kategorian ja liittää sen palautteeseen. Pitää tehä tästä sit se dropdown valikko?
        $category = new Category();
        $category->name = $validated['category'];
        $category->feedback_id = $feedback->id;  // Liittää nyt sen kategorian palautteeseen ja menee category tauluun
        $category->save();

        
        return redirect()->route('employee.dashboard')->with('success', 'Kategoria liitetty palautteelle onnistuneesti!');
    }
}