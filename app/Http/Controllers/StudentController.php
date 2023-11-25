<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subject;

class StudentController extends Controller
{
    /**
     * Zobrazí dashboard pro studenta.
     */
    public function index()
    {
        // Případná logika pro zobrazení dashboardu studenta
        return view('student.index');
    }

    /**
     * Zobrazí rozvrh studenta.
     */
    public function schedule()
    {
        // Případná logika pro získání a zobrazení rozvrhu studenta
        return view('student.schedule');
    }

    /**
     * Zobrazí seznam předmětů, do kterých je student zapsán.
     */
    public function enrolledSubjects()
    {
        $subjects = auth()->user()->subjects; // Předpokládá vztah mezi User a Subject
        return view('student.enrolled-subjects', compact('subjects'));
    }

    /**
     * Zobrazí informace o postupu studenta ve studiu.
     */
    public function progress()
    {
        // Případná logika pro zobrazení postupu studenta
        return view('student.progress');
    }

    // Další metody specifické pro studenta (např. zápis do předmětů, hodnocení, atd.)

    // Příklad metody pro zápis do předmětu
    public function enrollInSubject($subjectId)
    {
        // Logika pro zápis studenta do předmětu
    }
}
