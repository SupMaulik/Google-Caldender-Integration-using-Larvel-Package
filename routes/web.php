<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EeventController;
use Spatie\GoogleCalendar\Event;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {

    // get all future events on a calendar
    $events = Event::get();
    $data=compact('events');
    return view('dashboard')->with($data);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('addevents',[EeventController::class,'addevents']);
    Route::any('deleteevents/{id}',[EeventController::class,'delevents']);
    Route::any('update_event/{id}',[EeventController::class,'show_update']);
    Route::any('update_event/{id}',[EeventController::class,'show_update']);
    Route::any('edit_event/{id}',[EeventController::class,'edit_event']);
});

require __DIR__.'/auth.php';
