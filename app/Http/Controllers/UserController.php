<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('users.create');
    }
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
    public function edit(User $user): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Overenie ci je admin
//        if (auth()->user()->isAdmin() || auth()->user()->id === $user->id) {
//            return view('users.edit', compact('user'));
//
//        } else {
//            abort(403); // přístup odepřen
//        }
        return view('users.edit', compact('user'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'role' => 'required|in:user,admin,garant,teacher,scheduler,student'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();

        return redirect()->route('users.index')->with('status', 'profile-updated');
    }
    public function show($userId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $user = User::find($userId);
        return view('users.show', compact('user'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validácia vstupných údajov
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:8',
            'role' => 'required|in:user,admin,garant,teacher,scheduler,student',
        ]);

        // Vytvorenie používateľa a uloženie do databázy
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('users.index')->with('success', 'Používateľ vytvorený a uložený!');
    }
}
