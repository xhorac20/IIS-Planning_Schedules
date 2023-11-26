<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedules;


class SchedulerController extends Controller
{
    /**
     * Zobrazí rozvrhářský panel.
     */
    public function index()
    {
        // Případná logika pro zobrazení rozvrhářského panelu
        return view('scheduler.index');
    }

    /**
     * Zobrazí formulář pro vytvoření nového rozvrhu.
     */
    public function create()
    {
        // Případná logika pro zobrazení formuláře pro vytvoření rozvrhu
        return view('scheduler.create');
    }

    /**
     * Uloží nový rozvrh do databáze.
     */
    public function store(Request $request)
    {
        // Případná logika pro uložení nového rozvrhu
    }

    /**
     * Zobrazí formulář pro úpravu existujícího rozvrhu.
     */
    public function edit($id)
    {
        $schedule = Schedules::findOrFail($id);
        // Případná logika pro zobrazení formuláře pro úpravu rozvrhu
        return view('scheduler.edit', compact('schedule'));
    }

    /**
     * Aktualizuje existující rozvrh v databázi.
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedules::findOrFail($id);
        // Případná logika pro aktualizaci rozvrhu
    }

    /**
     * Odstraní existující rozvrh z databáze.
     */
    public function destroy($id)
    {
        $schedule = Schedules::findOrFail($id);
        $schedule->delete();
        // Případná logika pro odstranění rozvrhu
        return redirect()->route('scheduler.index');
    }

    // Další metody podle potřeby
}
