<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EducationalActivitiesController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "web" middleware group. Enjoy building your application!
|
*/

// Domovská stránka
Route::get('/', function () {
    return view('auth.login');
});

// Auth routy (pokud používáte Laravel Breeze nebo Jetstream, může být tento soubor importován níže)
// Auth::routes();

// Dashboard - chráněný middlewarem
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Profile routy - chráněné middlewarem
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Resource routy pro CRUD operace
Route::resource('users', UserController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('educational-activities', EducationalActivitiesController::class);
Route::resource('schedules', SchedulesController::class);
Route::resource('rooms', RoomsController::class);

// Routa pro procházení předmětů hosty
Route::get('/browse-subjects', [SubjectController::class, 'indexForGuest'])->name('guest.browse-subjects');

// Import autentizačních rout, pokud používáte Laravel Breeze nebo Jetstream
require __DIR__.'/auth.php';
