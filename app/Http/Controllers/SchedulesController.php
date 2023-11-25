<?php

namespace App\Http\Controllers;

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
    public function create()
    {
        // Zde můžete předat další data potřebná pro vytvoření rozvrhu
        return view('schedules.create');
    }

    /**
     * Uloží nově vytvořený rozvrh do databáze.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            // validace dat
        ]);

        $schedule = Schedules::create($validatedData);
        return redirect()->route('schedules.index')->with('success', 'Rozvrh byl úspěšně vytvořen.');
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
        return view('schedules.edit', compact('schedule'));
    }

    /**
     * Aktualizuje zvolený rozvrh v databázi.
     */
    public function update(Request $request, Schedules $schedule)
    {
        $validatedData = $request->validate([
            // validace dat
        ]);

        $schedule->update($validatedData);
        return redirect()->route('schedules.index')->with('success', 'Rozvrh byl úspěšně aktualizován.');
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
