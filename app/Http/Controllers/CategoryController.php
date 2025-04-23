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
        return view('admin.dashboard', compact('feedbacks')); //Näyttää palautteet nyt siellä employee sivulla
    }

    public function assign(Request $request, $feedback_id)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
        ]);

        // Tarkistetaan, löytyykö jo kategoria tälle palautteelle
        $existingCategory = Category::where('feedback_id', $feedback_id)->first();

        if ($existingCategory) {
            // Päivitetään olemassa olevan kategorian nimi
            $existingCategory->name = $validated['category'];
            $existingCategory->save();
        } else {
            // Luodaan uusi kategoria, jos sitä ei vielä ole
            $category = new Category();
            $category->name = $validated['category'];
            $category->feedback_id = $feedback_id;
            $category->save();
        }

        return redirect()->route('admin.dashboard')->with('success', 'Kategoria liitetty palautteelle onnistuneesti!');
    }


}