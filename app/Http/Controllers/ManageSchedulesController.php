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

    public function edit(Request $request)
    {
        $start_time = $request->input('start_time');
        $end_time = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $end_time->addMinutes($request->input('duration'));
        $localized = [
            'Po' => 'monday',
            'Ut' => 'tuesday',
            'St' => 'wednesday',
            'Št' => 'thursday',
            'Pi' => 'friday'
        ];

        // kontrola kolize místností
        $roomOk = Schedules::where('room_id', $request->input('room_id'))
                        ->where('day', $request->input('day'))
                        ->where(function ($query) use ($start_time, $end_time){
                            $query->whereBetween('start_time', [$start_time, $end_time->format('H:i')])
                                ->orWhereBetween('end_time', [$start_time, $end_time->format('H:i')]);
                        })->doesntExist();
        if(!$roomOk)
        {
            return redirect()->back()->with('failure', 'Chyba: zvolená místnost v tento čas není volná');
        }

        // kontrola požadavků na rozvrh
        $instructorOk = ScheduleRequirement::where('instructor_id', $request->input('instructor_id'))
                            ->where('day', $localized[$request->input('day')])
                            ->where(function ($query) use ($start_time, $end_time){
                                $query->where('start_time', '>', $end_time->format('H:i'))
                                    ->orWhere('end_time', '<', $start_time);
                            })->exists();

        if(!$instructorOk)
        {
            return redirect()->back()->with('failure', 'Chyba: zvolený vyučující v tento čas není volný');
        }

        Schedules::updateOrCreate(
            [
                'educational_activity_id' => $request->input('educational_activity_id'),
            ],
            [
                'room_id' => $request->input('room_id'),
                'instructor_id' => $request->input('instructor_id'),
                'day' => $request->input('day'),
                'start_time' => $request->input('start_time'),
                'end_time' => $end_time->format('H:i'),
            ]
        );

        return redirect()->back()->with('success', 'Výuková aktivita byla přidána do rozvrhu.');
    }
}
