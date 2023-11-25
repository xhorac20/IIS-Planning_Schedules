<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// Další modely, které můžete potřebovat

class AdminController extends Controller
{
    /**
     * Zobrazí administrační panel.
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Zobrazí správu uživatelů.
     */
    public function manageUsers()
    {
        $users = User::all(); // Získá všechny uživatele
        return view('admin.manage-users', compact('users'));
    }

    /**
     * Zobrazí správu místností.
     */
    public function manageRooms()
    {
        // Případná logika pro získání a zobrazení místností
        return view('admin.manage-rooms');
    }

    /**
     * Zobrazí správu předmětů.
     */
    public function manageSubjects()
    {
        // Případná logika pro získání a zobrazení předmětů
        return view('admin.manage-subjects');
    }

    // Další metody podle potřeby
}
