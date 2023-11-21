<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class SubjectController extends Controller
{
    // Metoda pro zobrazení anotací předmětů pro hosty (neregistrované uživatele)
    public function indexForGuest()
    {
        $subjects = Subject::all(); // Získání všech předmětů z databáze
        return view('guest.browse-subjects', compact('subjects'));
    }

    // ...zde mohou být další metody...
}
