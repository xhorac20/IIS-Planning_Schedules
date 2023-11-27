<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubjectController extends Controller
{
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $search = $request->input('search');

        if($search) {
            $subjects = Subject::where('name', 'like', "%$search%")
                ->orWhere('code', 'like', "%$search%")
                ->get();
        } else {
            $subjects = Subject::all();
        }

        session()->put('search', $request->input('search'));
        $users = User::all();

//        return view('subjects.index', compact('subjects'));
        return view('subjects.index', ['subjects' => $subjects, 'users' => $users]);
    }
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();
        return view('subjects.create', compact('users'));
    }

    public function edit($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Overenie ci je admin
//        if (auth()->user()->isAdmin() || auth()->user()->id === $user->id) {
//            return view('users.edit', compact('user'));
//
//        } else {
//            abort(403); // přístup odepřen
//        }
        $subject = Subject::findOrFail($id);
        $users = User::all();
        return view('subjects.edit', compact('subject'), compact('users'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $subject = Subject::findOrFail($id);

        $this->validate($request, [
            'code' => 'required|max:10',
            'name' => 'required|max:255',
            'annotation' => 'nullable',
            'credits' => 'required|numeric|max:30',
            'guarantor_id' => 'required',
        ]);

        $subject->code = $request->code;
        $subject->name = $request->name;
        $subject->annotation = $request->annotation;
        $subject->credits = $request->credits;
        $subject->guarantor_id = $request->guarantor_id;

        $subject->save();

        return redirect()->route('subjects.index', ['subject' => $subject['id']])->with('status', 'Subject "' . $subject->name . '" Updated!');
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        // Validácia vstupných údajov
        $this->validate($request, [
            'code' => 'required|max:10',
            'name' => 'required|max:255',
            'annotation' => 'nullable',
            'credits' => 'required|numeric|max:30',
            'guarantor_id' => 'required|numeric',
        ]);

        Subject::create([
            'code' => $request->input('code'),
            'name' => $request->input('name'),
            'annotation' => $request->input('annotation'),
            'credits' => $request->input('credits'),
            'guarantor_id' => $request->input('guarantor_id'),
        ]);

        return redirect()->route('subjects.index')
            ->with('success', 'Subject "' . $request->input('name') . '" Created !');
    }

    // Metoda pro zobrazení anotací předmětů pro hosty (neregistrované uživatele)
    public function indexForGuest()
    {
        $subjects = Subject::all(); // Získání všech předmětů z databáze
        return view('guest.browse-subjects', compact('subjects'));
    }

    // Metoda pro zobrazení detailů konkrétního předmětu
    public function show($id): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Najde předmět podle ID nebo vyvolá chybu 404
        $subject = Subject::findOrFail($id);

        // Zobrazí šablonu s detaily předmětu
        return view('subjects.show', compact('subject'));
    }


    // ...zde mohou být další metody...
}

