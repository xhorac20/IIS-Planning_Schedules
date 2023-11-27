<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\ManageSchedulesController;
use App\Http\Controllers\SchedulerController;
use App\Http\Controllers\ScheduleRequirementController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\EducationalActivitiesController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentScheduleController;

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
        Route::get('/manage-activities/{activityId}/schedule', [GuarantorController::class, 'manageOrCreateTimeTable'])->name('manage-activities.manage-schedule')->middleware('isGuarantor');
    });

    // Teacher routy
    Route::middleware(['isTeacher'])->group(function () {
        Route::get('/teacher/schedule', [TeacherController::class, 'schedule'])->name('teacher.schedule')->middleware('isTeacher');
        Route::get('/teacher/schedule-requirements', [ScheduleRequirementController::class, 'requirements'])->name('teacher.schedule-requirements')->middleware('isTeacher');
        Route::post('/teacher/schedule-requirements/edit', [ScheduleRequirementController::class, 'edit'])->name('schedule-requirements.edit')->middleware('isTeacher');
    });

    // Scheduler routy
    Route::middleware(['isScheduler'])->group(function () {
        Route::get('/scheduler/panel', [SchedulerController::class, 'index'])->name('scheduler.panel')->middleware('isScheduler');
        // TODO move to panel?
        Route::get('/scheduler/manage-schedules', [ManageSchedulesController::class, 'indexForScheduler'])->name('scheduler.manage-schedules')->middleware('isScheduler');
        Route::post('/scheduler/manage-schedules/edit', [ManageSchedulesController::class, 'edit'])->name('manage-schedules.edit')->middleware('isScheduler');
        Route::post('/scheduler/manage-schedules/remove', [ManageSchedulesController::class, 'remove'])->name('manage-schedules.remove')->middleware('isScheduler');
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

Route::post('/subject/{subject}/add-teacher', [GuarantorController::class, 'addTeacher'])->name('subject.add-teacher');
Route::delete('/subject/{subject}/remove-teacher/{teacher}', [GuarantorController::class, 'removeTeacher'])->name('subject.remove-teacher');

// Rúta na prechádzanie predmetov pre hostí
Route::get('/browse-subjects', [SubjectController::class, 'indexForGuest'])->name('guest.browse-subjects');

// Routa pre pridanie zmazanie a zobrazenie predmetu z a do studentskeho rozvrhu
Route::post('/schedule/add/{schedule}', [StudentScheduleController::class, 'add'])->name('student-schedule.add')->middleware('isStudent');
Route::delete('/student-schedule/remove/{scheduleId}', [StudentScheduleController::class, 'remove'])
    ->name('student-schedule.remove')
    ->middleware('isStudent');
Route::get('/student/schedule', [StudentScheduleController::class, 'showSchedule'])->name('student.schedule')->middleware('auth');

// Import autentizačních rout, Laravel Breeze
require __DIR__ . '/auth.php';

