<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    Auth::logout(); // Force logout any logged-in user
    return redirect()->route('login'); // Redirect to login page
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/notes/{note}', function (Note $note) {
    return view('note.show', ['note' => $note]);
})->name('notes.show');


Route::post('/notes/{note}/comments', [CommentController::class, 'store'])->name('comments.store');


Route::post('/notes/{note}/like', [LikeController::class, 'toggle'])->name('notes.like');



// Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');

Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth'])->name('home');

Route::get('/manage', function () {
    return view('manage');
})->middleware(['auth'])->name('manage');

require __DIR__ . '/auth.php';