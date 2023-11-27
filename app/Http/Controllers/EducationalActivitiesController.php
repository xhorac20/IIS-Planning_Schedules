<?php

namespace App\Http\Controllers;

use App\Models\EducationalActivities;
use App\Models\Rooms;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EducationalActivitiesController extends Controller
{

    /**
     * Zobraziť zoznam všetkých výukových aktivít.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function index()
    {
        $activities = EducationalActivities::all();
        return view('educational_activities.index', compact('activities'));
    }

    /**
     * Zobraziť formulár pre vytvorenie novej výukovej aktivity.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function create()
    {
        /// Získajte ID aktuálne prihláseného garanta
        $guarantorId = auth()->id();

        // Načítajte predmety, pre ktoré je prihlásený užívateľ garant
        $subjects = Subject::where('guarantor_id', $guarantorId)->get();

        // Pošlite predmety do šablóny
        return view('educational_activities.create', compact('subjects'));
    }

    /**
     * Uložiť novú výukovú aktivitu do databázy.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        // Validácia a uloženie údajov z $request
        EducationalActivities::create($request->all());

        return redirect()->route('guarantor.manage-activities')->with('success', 'Aktivita bola úspešne pridaná.');
    }

    /**
     * Zobraziť špecifickú výukovú aktivitu.
     *
     * @param EducationalActivities $educationalActivity
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function show(EducationalActivities $educationalActivity)
    {
        return view('educational_activities.show', compact('educationalActivity'));
    }

    /**
     * Zobraziť formulár pre úpravu existujúcej výukovej aktivity.
     *
     * @param EducationalActivities $educationalActivity
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(EducationalActivities $educationalActivity)
    {
        // Získanie súvisiaceho predmetu
        $subject = $educationalActivity->subject;

        // Získanie ID učiteľov priradených k predmetu
        $teacherIds = $subject->teacher_ids ?? [];

        // Pridanie ID garanta do zoznamu
        $teacherIds[] = $subject->guarantor_id;

        // Získanie učiteľov a garanta
        $teachers = User::whereIn('id', $teacherIds)->get();

        // Získanie miestností
        $rooms = Rooms::all();

        $preferredDayTime = json_decode(json: $educationalActivity->preferred_day_time, associative: true);

        return view('educational_activities.edit', [
            'educationalActivity' => $educationalActivity,
            'rooms' => $rooms,
            'teachers' => $teachers,
            'subject' => $subject,
            'preferredDayTime' => $preferredDayTime

        ]);
    }

    /**
     * Aktualizovať existujúcu výukovú aktivitu v databáze.
     *
     * @param Request $request
     * @param EducationalActivities $educationalActivity
     * @return RedirectResponse
     */
    public function update(Request $request, EducationalActivities $educationalActivity)
    {
        // Validácia údajov...
        $validatedData = $request->validate([
            'preferred_time' => 'array',
            'preferred_time.*.start' => 'nullable|date_format:H:i',
            'preferred_time.*.end' => 'nullable|date_format:H:i|after_or_equal:preferred_time.*.start',
            // Iné validácie...
        ]);

        // Zloženie JSON objektu pre preferovaný čas
        $preferredDayTime = json_encode($request->input('preferred_time'));

        // Aktualizujte údaje...
        $data = $request->except('event_date', 'preferred_time');
        $data['preferred_day_time'] = $preferredDayTime;

        if ($request->input('repetition') !== 'Jednorázovo') {
            $data['event_date'] = null;
        } else {
            $data['event_date'] = $request->input('event_date');
        }

        // Aktualizácia údajov...
        $educationalActivity->update($data);

        return redirect()->route('guarantor.manage-activities')->with('success', 'Aktivita bola úspešne aktualizovaná.');
    }


    /**
     * Odstrániť existujúcu výukovú aktivitu z databázy.
     *
     * @param EducationalActivities $educationalActivity
     * @return RedirectResponse
     */
    public function destroy(EducationalActivities $educationalActivity)
    {
        $educationalActivity->delete();

        return redirect()->route('guarantor.manage-activities')->with('success', 'Aktivita bola úspešne odstránená.');
    }

    // Ďalšie metódy podľa potreby
}
