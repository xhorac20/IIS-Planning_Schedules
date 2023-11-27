<?php

namespace App\Http\Controllers;

use App\Models\Schedules;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Http\Request;
use App\Models\EducationalActivities;
use App\Models\Rooms;
use App\Models\ScheduleRequirement;

class ManageSchedulesController extends Controller
{
    public function indexForScheduler()
    {
        $schedules = Schedules::with('educationalActivity', 'room', 'instructor')->get();
        $activities = EducationalActivities::with('subject')
            ->join('subjects', 'subjects.id', '=', 'educational_activities.subject_id')
            ->orderBy('subjects.name')
            ->select('educational_activities.*')
            ->get();
        $rooms = Rooms::all();
        $requirements = ScheduleRequirement::with('instructor')->orderByRaw("FIELD(day, 'monday', 'tuesday', 'wednesday', 'thursday', 'friday')")->get();
        return view('scheduler.manage-schedules', compact('schedules', 'activities', 'rooms', 'requirements'));
    }

    public function edit(Request $request)
    {
        $localized = [
            'Po' => 'monday',
            'Ut' => 'tuesday',
            'St' => 'wednesday',
            'Št' => 'thursday',
            'Pi' => 'friday'
        ];
        $day = $localized[$request->input('day')];

        $start = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $end = Carbon::createFromFormat('H:i', $request->input('start_time'));
        $end->addMinutes($request->input('duration'));
        $start_time = $start->format('H:i:s');
        $end_time = $end->format('H:i:s');

        // kontrola kolize místností
        $roomEmpty = Schedules::where('room_id', $request->input('room_id'))
                        ->where('day', $request->input('day'))
                        ->where(function ($query) use ($start_time, $end_time){
                            $query->whereBetween('start_time', [$start_time, $end_time])
                                ->orWhereBetween('end_time', [$start_time, $end_time]);
                        })->doesntExist();
        if(!$roomEmpty)
        {
            return redirect()->back()->with('failure', 'Chyba: zvolená místnost v tento čas není volná');
        }

        // kontrola požadavků na rozvrh
        $dayReq = ScheduleRequirement::where('instructor_id', $request->input('instructor_id'))->where('day', $day)->first();
        if($dayReq)
        {
            if($start_time < $dayReq->start_time || $end_time > $dayReq->end_time)
            {
                return redirect()->back()->with('failure', 'Chyba: zvolený vyučující v tento čas není volný');
            }
        }
        else
        {
            return redirect()->back()->with('failure', 'Chyba: zvolený vyučující v tento den není volný');
        }

        Schedules::updateOrCreate(
            [
                'educational_activity_id' => $request->input('educational_activity_id'),
            ],
            [
                'room_id' => $request->input('room_id'),
                'instructor_id' => $request->input('instructor_id'),
                'day' => $request->input('day'),
                'start_time' => $start_time,
                'end_time' => $end_time,
            ]
        );

        return redirect()->back()->with('success', 'Výuková aktivita byla přidána do rozvrhu.');
    }

    public function remove(Request $request)
    {
        $ids = $request->input('schedules_id', []);
        foreach ($ids as $id)
        {
            $schedule = Schedules::where('id', $id);
            if($schedule){
                $schedule->delete();
            }
        }
        return redirect()->back()->with('successRemove', 'Odebrání z rozvrhu proběhlo úspěšně.');
    }
}
