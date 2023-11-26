<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use App\Models\StudentSchedule;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class StudentScheduleController extends Controller
{
    public function add($subjectId)
    {
        $user = Auth::user(); // Získajte aktuálne prihláseného študenta

        // Získanie všetkých rozvrhových ID pre daný predmet
        $scheduleIds = Schedules::join('educational_activities', 'schedules.educational_activity_id', '=', 'educational_activities.id')
            ->where('educational_activities.subject_id', $subjectId)
            ->pluck('schedules.id');

        // Skontrolujte, či už študent nemá niektorú z aktivít predmetu v rozvrhu
        foreach ($scheduleIds as $scheduleId) {
            $existingSchedule = StudentSchedule::where('user_id', $user->id)
                ->where('schedule_id', $scheduleId)
                ->first();

            if ($existingSchedule) {
                continue; // Ak už existuje, preskočte na ďalšie ID
            }

            // Pridajte rozvrhovú položku do rozvrhu
            StudentSchedule::create([
                'user_id' => $user->id,
                'schedule_id' => $scheduleId
            ]);
        }

        return redirect()->back()->with('success', 'Predmet bol úspešne pridaný do rozvrhu.');
    }


    public function remove($subjectId)
    {
        $user = auth()->user(); // Získajte aktuálne prihláseného študenta

        // Získanie všetkých rozvrhových ID pre daný predmet
        $scheduleIds = Schedules::join('educational_activities', 'schedules.educational_activity_id', '=', 'educational_activities.id')
            ->where('educational_activities.subject_id', $subjectId)
            ->pluck('schedules.id');

        // Pre každé ID rozvrhovej položky skontrolujte, či existuje v študentskom rozvrhu, a ak áno, odstráňte ho
        foreach ($scheduleIds as $scheduleId) {
            $scheduleToRemove = StudentSchedule::where('user_id', $user->id)
                ->where('schedule_id', $scheduleId)
                ->first();

            if ($scheduleToRemove) {
                $scheduleToRemove->delete(); // Odstránenie rozvrhovej položky
            }
        }

        return redirect()->back()->with('success', 'Predmet bol úspešne odstránený z rozvrhu.');
    }


    public function showSchedule()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $studentSchedules = StudentSchedule::where('user_id', $user->id)
            ->with(['schedule' => function ($query) use ($today) {
                $query->with(['educationalActivity' => function ($query) use ($today) {
                    $query->where(function ($query) use ($today) {
                        $query->where('repetition', '!=', 'Jednorázovo')
                            ->orWhere(function ($query) use ($today) {
                                $query->where('repetition', '=', 'Jednorázovo')
                                    ->whereDate('event_date', '>=', $today);
                            });
                    });
                    $query->with('subject', 'room');
                }, 'room']);
            }])->get();

        $scheduleData = [];
        foreach ($studentSchedules as $studentSchedule) {
            if ($studentSchedule->schedule && $studentSchedule->schedule->educationalActivity) {
                $day = $studentSchedule->schedule->day;
                $startHour = Carbon::parse($studentSchedule->schedule->start_time)->format('G');
                $educationalActivity = $studentSchedule->schedule->educationalActivity;
                $duration = $educationalActivity->duration;
                $subjectCode = $educationalActivity->subject->code;
                $type = $educationalActivity->type;
                $roomName = $studentSchedule->schedule->room->name;
                $repetition = $educationalActivity->repetition;
                $event_date = $educationalActivity->event_date;

                $scheduleData[$day][$startHour][] = [
                    'subject' => $subjectCode,
                    'type' => $type,
                    'room' => $roomName,
                    'duration' => $duration,
                    'repetition' => $repetition,
                    'event_date' => $event_date
                ];
            }
        }

        return view('student.student-schedule', compact('scheduleData'));
    }
}

