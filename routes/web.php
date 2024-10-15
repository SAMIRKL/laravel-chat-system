<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Events\Example;
// use App\Events\Mehrnaz;
// use Illuminate\Support\Auth;
use App\Livewire\Chat;
use App\Models\Room;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard/chats', function () {
    return view('chats', ['rooms' => Room::all()]);
})->middleware(['auth'])->name('dashboard.chats');


// Route::get('', function () {
    // broadcast(new Example(auth()->user(),));
// });

Route::get('/dashboard/room/{room}', Chat::class)->middleware(['auth'])->name('dashboard.room');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
