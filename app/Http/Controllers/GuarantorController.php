<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use App\Models\Schedules;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\EducationalActivities;

// Další potřebné modely

class GuarantorController extends Controller
{
    /**
     * Zobrazí panel pro správu výukových aktivit.
     */
    public function manageActivities()
    {
        // Získajte ID a rolu aktuálne prihláseného užívateľa
        $userId = auth()->id();
        $userRole = auth()->user()->role;

        // Ak je používateľ admin, načítajte všetky predmety
        // Inak načítajte len predmety, pre ktoré je prihlásený užívateľ garant
        $subjects = $userRole === 'admin' ? Subject::all() : Subject::where('guarantor_id', $userId)->get();


        // Získanie dostupných učiteľov, okrem aktuálne prihláseného užívateľa
        $availableTeachers = User::where('role', 'teacher')
            ->orWhere('role', 'guarantor')
            ->where('id', '!=', $userId) // Vylúčiť aktuálneho užívateľa
            ->get();

        // Získanie priradených učiteľov pre každý predmet
        $assignedTeachers = [];
        foreach ($subjects as $subject) {
            $teacherIds = $subject->teacher_ids ?? [];
            $assignedTeachers[$subject->id] = User::whereIn('id', $teacherIds)->get();
        }

        // Získanie výukových aktivít pre každý predmet
        $activities = [];
        foreach ($subjects as $subject) {
            $activities[$subject->id] = EducationalActivities::where('subject_id', $subject->id)->get();
        }

        return view('guarantor.manage-activities', compact('subjects', 'activities', 'assignedTeachers', 'availableTeachers'));
    }


    public function manageOrCreateTimeTable($activityId)
    {
        // Skontrolujte, či už existuje rozvrh pre danú aktivitu
        $schedule = Schedules::where('educational_activity_id', $activityId)->first();

        if ($schedule) {
            // Presmerujte na editáciu existujúceho rozvrhu
            return redirect()->route('schedules.edit', $schedule->id);
        } else {
            // Presmerujte na vytvorenie nového rozvrhu
            return redirect()->route('schedules.create', ['activity' => $activityId]);
        }
    }

    public function addTeacher(Request $request, $subject)
    {
        // Získanie ID učiteľa z formulára
        $teacherId = $request->input('teacher_id');

        // Načítanie predmetu a pridanie učiteľa
        $subject = Subject::find($subject);
        $subject->addTeacher($teacherId);

        // Redirect back with success message
        return redirect()->route('guarantor.manage-activities')->with('success', 'Učiteľ bol úspešne pridaný.');
    }


    public function removeTeacher($subjectId, $teacherId)
    {
        $subject = Subject::findOrFail($subjectId);
        $subject->removeTeacher($teacherId);

        // Redirect back with success message
        return redirect()->route('guarantor.manage-activities')->with('success', 'Učiteľ bol úspešne odstránený.');
    }

}
