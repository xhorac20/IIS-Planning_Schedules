<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    // V ProfileController nebo jiném relevantním controlleru
    public function showSubjects()
    {
        $user_subjects = Auth::user()->subjects; // Získání předmětů, které uživatel garantuje
        $subjects = Subject::all(); // Získání všech předmětů

        return view('guest.browse-subjects', compact('user_subjects', 'subjects'));
    }


}
