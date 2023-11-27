<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use App\Models\Subject;
use Auth;

class UserController extends Controller
{
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('users.create');
    }
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $search = $request->input('search');

        if($search) {
            $users = User::where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->get();
        } else {
            $users = User::all();
        }
        session()->put('search', $request->input('search'));
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
            'password' => 'nullable|min:8',
            'role' => 'required|in:user,admin,guarantor,teacher,scheduler,student'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('users.index', ['user' => $user->id])->with('status', 'User "' . $user->name . '" Updated!');
    }
    public function destroy($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User "' . $user->name . '" was deleted!');
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
            'role' => 'required|in:user,admin,guarantor,teacher,scheduler,student',
        ]);

        // Vytvorenie používateľa a uloženie do databázy
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'User "' . $request->input('name') . '" Created !');
    }
    // V ProfileController nebo jiném relevantním controlleru
    public function showSubjects()
    {
        $user_subjects = Auth::user()->subjects; // Získání předmětů, které uživatel garantuje
        $subjects = Subject::all(); // Získání všech předmětů

        return view('guest.browse-subjects', compact('user_subjects', 'subjects'));
    }


}
