<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Metoda pro zobrazení anotací předmětů pro hosty (neregistrované uživatele)
    public function indexForGuest()
    {
        $subjects = Subject::all(); // Získání všech předmětů z databáze
        return view('guest.browse-subjects', compact('subjects'));
    }

    // Metoda pro zobrazení detailů konkrétního předmětu
    public function show($id)
    {
        // Najde předmět podle ID nebo vyvolá chybu 404
        $subject = Subject::findOrFail($id);

        // Zobrazí šablonu s detaily předmětu
        return view('subjects.show', compact('subject'));
    }


    // ...zde mohou být další metody...
}

