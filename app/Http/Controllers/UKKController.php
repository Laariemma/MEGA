<?php 


namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Category;
use App\Models\Suggestion;
use App\Models\Strategy;
use Illuminate\Http\Request;

class UKKController extends Controller 
{    
    public function index(Request $request)
{
    // Hakee kaikki uniikit kategoriat dropdown-valikkoa varten
    $categories = Category::distinct()->get(['name']);

    $suggestions = collect(); // Tyhjä kokoelma oletuksena

    if ($request->has('category_name') && $request->category_name !== '') {
        if ($request->category_name === 'Kaikki') {
            // Näytetään vain ne joilla on kategoria
            $suggestions = Suggestion::with('feedback.answers.employee')
                ->whereHas('feedback.category') // Vain ne joilla on kategoria
                ->get();
        } else {
            // Suodatetaan valitun kategorian mukaan
            $suggestions = Suggestion::with('feedback.answers.employee')
                ->whereHas('feedback', function ($query) use ($request) {
                    $query->whereHas('category', function ($categoryQuery) use ($request) {
                        $categoryQuery->where('name', $request->category_name);
                    });
                })
                ->get();
        }
    }

   
$strategies = Strategy::with('feedback.answers.employee', 'feedback.comments.user')->get();
return view('ukk', compact('suggestions', 'categories', 'strategies'));
}
}


