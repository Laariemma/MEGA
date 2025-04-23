<?php 


namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Category;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class UKKController extends Controller 
{    
    public function index(Request $request)
{
    // Hakee kaikki uniikit kategoriat dropdown-valikkoa varten
    $categories = Category::distinct()->get(['name']);

    // Jos kategoria on valittu, suodatetaan sen mukaan
    if ($request->has('category_name') && $request->category_name != '') {
        $suggestions = Suggestion::with('feedback')
            ->whereHas('feedback', function ($query) use ($request) {
                // Suodatetaan palautteet valitun kategorian mukaan
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('name', $request->category_name);
                });
            })
            ->get();
    } else {
        // Jos ei valittu kategoriaa, näytetään kaikki ehdotukset
        $suggestions = Suggestion::with('feedback')->get();
    }

    // Lähetetään muuttujat näkymään
    return view('ukk', compact('suggestions', 'categories'));
}

    


}
