<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ClosedTicketController;
use App\Models\Feedback;
use App\Http\Controllers\UKKController;

/*
|--------------------------------------------------------------------------
| Julkiset reitit
|--------------------------------------------------------------------------
*/

// Etusivu
Route::get('/', [FeedbackController::class, 'index']);

// FAQ

Route::get('/ukk', [UKKController::class, 'index'])->name('ukk');


// KPI 
Route::get('/feedback-count', function () {
    $count = Feedback::count();
    return response()->json(['count' => $count]);
});

/*
|--------------------------------------------------------------------------
| Auth (Laravel Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

Route::get('/dashboard', function () {
    return redirect()->route('employee.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profiili
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Kommentointi
    Route::post('/comments/{id}', [CommentController::class, 'store'])->name('comments.store');
});

/*
|--------------------------------------------------------------------------
| Admin-reitit
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard'); 
    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks');
    Route::get('/feedbacks/{id}/edit', [FeedbackController::class, 'edit'])->name('feedbacks.edit'); 
    Route::post('/feedbacks/{id}/update', [FeedbackController::class, 'update'])->name('feedbacks.update'); 
    Route::post('/feedbacks/{id}/delete', [FeedbackController::class, 'destroy'])->name('feedbacks.delete');
    Route::post('/assign-category/{feedback_id}', [CategoryController::class, 'assign'])->name('category.assign');

});

/*
|--------------------------------------------------------------------------
| Työntekijän dashboard
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/employee/dashboard', [FeedbackController::class, 'showDashboard'])->name('employee.dashboard');

    // Tiketin sulkeminen
    Route::post('/sulje-tiketti/{id}', [ClosedTicketController::class, 'closeTicket'])->name('ticket.close');

    //Answer
    Route::post('/feedback/{id}/answer', [AnswerController::class, 'store'])->name('feedback.answer');

    // Kategorian valinta
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::post('/categories/{feedback_id}', [CategoryController::class, 'assign'])->name('category.assign');

    // Vastaukset
    Route::post('/feedback/{feedback}/answers', [AnswerController::class, 'store'])->name('answers.store');

    //ehdotukset
    Route::post('/feedback/{id}/suggest', [FeedbackController::class, 'pushToAdminAsSuggestion'])->name('feedback.suggest');
});

/*
|--------------------------------------------------------------------------
| Muut
|--------------------------------------------------------------------------
*/

// Palautteen lähetys 
Route::post('/submit', [FeedbackController::class, 'store'])->name('feedback.submit');

// Palautteet one by one
Route::get('/feedbacks/{id}', [FeedbackController::class, 'show'])->name('feedbacks.show');

// Suljetut tiketit 
Route::get('/closed-tickets', [ClosedTicketController::class, 'showClosedTickets']);