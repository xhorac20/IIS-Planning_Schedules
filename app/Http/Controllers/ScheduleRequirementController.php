<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleRequirement;
use Auth;

class ScheduleRequirementController extends Controller
{
    public function requirements()
    {
        // TODO check if teacher has any assigned subjects
        $user = Auth::user();
        $scheduleRequirements = $user->scheduleRequirements()->get()->keyBy('day');
        return view('teacher.schedule-requirements', compact('scheduleRequirements'));
    }
    public function edit(Request $request)
    {
        //ddd($request);
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
        $user = Auth::user();

        foreach($days as $day)
        {
            if($request->input($day) == 'on')
            {
                $start = 'start_' . $day;
                $end = 'end_' . $day;

                ScheduleRequirement::updateOrCreate(
                    [
                        'instructor_id' => $user->id,
                        'day' => $day,
                    ],
                    [
                        'start_time' => $request->input($start),
                        'end_time' => $request->input($end),
                    ]
                );
            }
            else
            {
                $requirement = ScheduleRequirement::where('instructor_id', $user->id)
                    ->where('day', $day);
                if($requirement)
                {
                    $requirement->delete();
                }
            }
        }

        return redirect()->back()->with('success', 'Požadavky na rozvrh byly úspěšně uloženy.');
    }
}
