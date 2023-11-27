<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedules;

// Další modely, které můžete potřebovat

class TeacherController extends Controller
{
    /**
     * Zobrazí rozvrh vyučujícího.
     */
    public function schedule()
    {
        $schedules = Schedules::where('id', auth()->id())->get(); // Získá rozvrh přihlášeného učitele
        return view('teacher.schedule', compact('schedules'));
    }

    public function scheduleRequirements()
    {
        // TODO check if teacher has any assigned subjects
        return view('teacher.schedule-requirements');
    }

    // Další metody specifické pro vyučujícího (např. správa výukových materiálů, sledování postupu studentů, atd.)

    // Příklad metody pro správu výukových materiálů
    public function manageMaterials()
    {
        // Logika pro správu výukových materiálů
    }

    // Příklad metody pro sledování postupu studentů
    public function trackStudentProgress()
    {
        // Logika pro sledování postupu studentů
    }
}
