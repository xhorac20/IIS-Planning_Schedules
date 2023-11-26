<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EducationalActivities;
use App\Models\Rooms;
use App\Models\ScheduleRequirement;

// TODO check conflicts
class ManageSchedulesController extends Controller
{
    public function indexForScheduler()
    {
        $activities = EducationalActivities::with('subject')
            ->join('subjects', 'subjects.id', '=', 'educational_activities.subject_id')
            ->orderBy('subjects.name')
            ->select('educational_activities.*')
            ->get();
        $rooms = Rooms::all();
        $requirements = ScheduleRequirement::with('instructor')->orderByRaw("FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday')")->get();
        return view('scheduler.manage-schedules', compact('activities', 'rooms', 'requirements'));
    }

    public function add(Request $request)
    {
        $end = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $end->addMinutes($request->input('duration'));

        Schedules::create([
            'educational_activity_id' => $request->input('educational_activity_id'),
            'room_id' => $request->input('room_id'),
            'instructor_id' => $request->input('instructor_id'),
            'day' => $request->input('day'),
            'start_time' => $request->input('start_time'),
            'end_time' => $end->format('H:i'),
        ]);

        return redirect()->back()->with('success', 'Výuková aktivita byla přidána do rozvrhu.');
    }
}
