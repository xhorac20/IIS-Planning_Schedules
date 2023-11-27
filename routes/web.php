<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
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

// Cesty pre user
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->name('users.save');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/users/{user}', [UserController::class, 'update']);

// Cesty pre Room Management
Route::get('/rooms', [RoomsController::class, 'index'])->name('rooms.index');
Route::get('/rooms/create', [RoomsController::class, 'create'])->name('rooms.create');
Route::post('/rooms/create', [RoomsController::class, 'store'])->name('rooms.save');
Route::get('/rooms/{room}/edit', [RoomsController::class, 'edit'])->name('rooms.edit');
Route::patch('/rooms/{room}', [RoomsController::class, 'update']);

// Cesty pre Subjects Management
Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
Route::get('/subjects/create', [SubjectController::class, 'create'])->name('subjects.create');
Route::post('/subjects/create', [SubjectController::class, 'store'])->name('subjects.save');
Route::get('/subjects/{room}/edit', [SubjectController::class, 'edit'])->name('subjects.edite');
Route::patch('/subjects/{room}', [SubjectController::class, 'update']);

// Dashboard - chráněný middlewarem
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Routy pro CRUD operace
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routy
    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin.panel')->middleware('isAdmin');
        Route::get('/manage/users', [AdminController::class, 'manageUsers'])->name('manage.users')->middleware('isAdmin');
        Route::get('/manage/rooms', [AdminController::class, 'manageRooms'])->name('manage.rooms')->middleware('isAdmin');
        Route::get('/manage/subjects', [AdminController::class, 'manageSubjects'])->name('manage.subjects')->middleware('isAdmin');
    });

    // Guarantor routy
    Route::middleware(['isGuarantor'])->group(function () {
        Route::get('/guarantor/activities', [GuarantorController::class, 'manageActivities'])->name('guarantor.manage-activities')->middleware('isGuarantor');
        Route::get('/guarantor/assign-teachers', [GuarantorController::class, 'assignTeachers'])->name('guarantor.assign-teachers')->middleware('isGuarantor');
    });

    // Teacher routy
    Route::middleware(['isTeacher'])->group(function () {
        Route::get('/teacher/schedule', [TeacherController::class, 'schedule'])->name('teacher.schedule')->middleware('isTeacher');
    });

    // Scheduler routy
    Route::middleware(['isScheduler'])->group(function () {
        Route::get('/scheduler/panel', [SchedulerController::class, 'index'])->name('scheduler.panel')->middleware('isScheduler');
    });

    // Student routy
    Route::middleware(['isStudent'])->group(function () {
        Route::get('/student/schedule', [StudentController::class, 'schedule'])->name('student.schedule')->middleware('isStudent');
    });
});

// Resource routy pro CRUD operace
Route::resource('users', UserController::class);
Route::resource('subjects', SubjectController::class);
Route::resource('educational-activities', EducationalActivitiesController::class);
Route::resource('schedules', SchedulesController::class);
Route::resource('rooms', RoomsController::class);

// Rúta na prechádzanie predmetov pre hostí
Route::get('/browse-subjects', [SubjectController::class, 'indexForGuest'])->name('guest.browse-subjects');

// Routa pre pridanie predmetu do rozvrhu
Route::post('/schedules/add/{subject}', [SchedulesController::class, 'add'])->name('schedule.add')->middleware('auth');

// Import autentizačních rout, pokud používáte Laravel Breeze nebo Jetstream
require __DIR__ . '/auth.php';

