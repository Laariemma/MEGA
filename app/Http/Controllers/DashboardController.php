<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback; 

class DashboardController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::all();
    
        return view('admin.dashboard', compact('feedbacks'));
    }

    

}