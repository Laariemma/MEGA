<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ukk', function () {
    return view('ukk');
})->name('ukk');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
    Route::get('/feedbacks/{id}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit'); 
    Route::post('/feedbacks/{id}/update', [FeedbackController::class, 'update'])->name('feedbacks.update'); 
    Route::post('/feedbacks/{id}/delete', [FeedbackController::class, 'destroy'])->name('feedbacks.delete'); 
});

Route::get('/employee/dashboard', [FeedbackController::class, 'showDashboard'])->name('employee.dashboard');//tuo palautteet employeee sivulle
Route::get('/', [FeedbackController::class, 'index']);
Route::post('/submit', [FeedbackController::class, 'store']);



Route::get('/employee/dashboard', [CategoryController::class, 'index'])->name('employee.dashboard'); // tuo ne tiedot millä ei oo kategoriaa
Route::post('categories/{feedback_id}', [CategoryController::class, 'assign'])->name('category.assign'); //laittaa sen kategorian
//kommentointiin tämän alla olevat
Route::middleware(['auth'])->group(function () {
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::get('/feedbacks/{id}', [FeedbackController::class, 'show'])->name('feedbacks.show');
    
    Route::post('/feedbacks/{id}/comment', [CommentController::class, 'store'])->name('comments.store');
});
Route::get('/admin', [FeedbackController::class, 'index'])->middleware('auth', 'admin')->name('admin.dashboard');
Route::post('/comments/{id}', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');