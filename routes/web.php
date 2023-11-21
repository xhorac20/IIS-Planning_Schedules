<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EducationalActivitiesController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\RoomsController;

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

// Tato routa vrací zobrazení domovské stránky. Můžete ji změnit tak, aby odrážela hlavní stránku vašeho systému.
Route::get('/', function () {
    return view('auth.login');
});

// Autentizační routy (pokud používáte Laravel Breeze, Jetstream, atd.)
Auth::routes();

// User routy
Route::resource('users', UserController::class);

// Subject routy
Route::resource('subjects', SubjectController::class);

// EducationalActivity routy
Route::resource('educational-activities', EducationalActivitiesController::class);

// Schedule routy
Route::resource('schedules', SchedulesController::class);

// Room routy
Route::resource('rooms', RoomsController::class);

// Další routy, které mohou být potřeba...
