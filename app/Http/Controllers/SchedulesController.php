<?php

namespace App\Http\Controllers;

use App\Models\EducationalActivities;
use App\Models\Rooms;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Models\Schedules;

class SchedulesController extends Controller
{
    /**
     * Zobrazí seznam všech rozvrhů.
     */
    public function index()
    {
        $schedules = Schedules::all();
        return view('schedules.index', compact('schedules'));
    }

    /**
     * Zobrazí formulář pro vytvoření nového rozvrhu.
     */
    public function create(Request $request)
    {
        $activityId = $request->query('activity');
        $currentActivity = EducationalActivities::findOrFail($activityId);
        $subject = $currentActivity->subject;
        $activityType = $currentActivity->type;

        // Získanie ostatných potrebných dát
        $rooms = Rooms::all();
        $teachers = User::where('role', 'teacher')
            ->orWhere('role', 'scheduler')
            ->orWhere('role', 'guarantor')
            ->get();

        return view('schedules.create', [
            'rooms' => $rooms,
            'teachers' => $teachers,
            'subjectName' => $subject->name,
            'activityType' => $activityType,
            'currentActivity' => $currentActivity
        ]);
    }


    /**
     * Uloží nově vytvořený rozvrh do databáze.
     */
    public function store(Request $request)
    {
        Schedules::create($request->all());

        return redirect()->route('guarantor.manage-activities')->with('success', 'Rozvrh byl úspěšně vytvořen.');
    }

    /**
     * Zobrazí zvolený rozvrh.
     */
    public function show(Schedules $schedule)
    {
        return view('schedules.show', compact('schedule'));
    }

    /**
     * Zobrazí formulář pro úpravu existujícího rozvrhu.
     */
    public function edit(Schedules $schedule)
    {
        $rooms = Rooms::all(); // Získanie všetkých miestností
        $teachers = User::where('role', 'teacher') // Získanie všetkých učiteľov a podobných rolí
        ->orWhere('role', 'scheduler')
            ->orWhere('role', 'guarantor')
            ->get();

        // Získanie súvisiacej výukovej aktivity a predmetu
        $currentActivity = $schedule->educationalActivity;
        $subject = $currentActivity->subject;

        return view('schedules.edit', [
            'schedule' => $schedule,
            'rooms' => $rooms,
            'teachers' => $teachers,
            'currentActivity' => $currentActivity,
            'subject' => $subject
        ]);
    }

    /**
     * Aktualizuje zvolený rozvrh v databázi.
     */
    public function update(Request $request, Schedules $schedule)
    {
        $validatedData = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'instructor_id' => 'required|exists:users,id',
            'day' => 'required|in:Po,Ut,St,Št,Pi',
            'start_time' => 'required|date_format:H:i|before:end_time',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $schedule->update($validatedData);
        return redirect()->route('guarantor.manage-activities')->with('success', 'Rozvrh byl úspěšně aktualizován.');
    }

    /**
     * Odstraní zvolený rozvrh z databáze.
     */
    public function destroy(Schedules $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Rozvrh byl úspěšně odstraněn.');
    }

    // Zde můžete přidat další metody podle potřeby, jako jsou metody pro přiřazení aktivit k rozvrhu, atd.
}
