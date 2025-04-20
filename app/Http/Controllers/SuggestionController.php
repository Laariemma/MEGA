<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuggestionController extends Controller
{   
    public function index()
    {
        
        $suggestions = Suggestion::all();
        
        return view('admin.dashboard', compact('suggestions'));
    }
}
