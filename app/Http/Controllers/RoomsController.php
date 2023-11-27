<?php

namespace App\Http\Controllers;

use App\Models\Rooms;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RoomsController extends Controller
{
    //
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('rooms.create');
    }
    public function index(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $search = $request->input('search');

        if($search) {
            $rooms = Rooms::where('name', 'like', "%$search%")->get();
        } else {
            $rooms = Rooms::all();
        }
        session()->put('search', $request->input('search'));
        return view('rooms.index', compact('rooms'));
    }
    public function edit(Rooms $room): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        // Overenie ci je admin
//        if (auth()->user()->isAdmin() || auth()->user()->id === $user->id) {
//            return view('users.edit', compact('user'));
//
//        } else {
//            abort(403); // přístup odepřen
//        }
        return view('rooms.edit', compact('room'));
    }

    /**
     * @throws ValidationException
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $room = Rooms::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'location' => 'required|max:255',
            'capacity' => 'required|numeric',
        ]);

        $room->name = $request->name;
        $room->location = $request->location;
        $room->capacity = $request->capacity;

        $room->save();

        return redirect()->route('rooms.index', ['room' => $room->id])->with('status', 'Room "' . $room->name . '" Updated!');
    }

    public function show($userId): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $room = Rooms::find($userId);
        return view('rooms.show', compact('room'));
    }
    public function destroy($id): RedirectResponse
    {
        $room = Rooms::findOrFail($id);
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room "' . $room->name . '" was deleted!');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
                'location' => 'required|max:255',
                'capacity' => 'required|numeric',
            ]);

            // uloženie údajov

        } catch (\Illuminate\Validation\ValidationException $e) {

            // spracovanie chyby validácie
            return redirect()
                ->route('rooms.index')
                ->withErrors($e->errors())
                ->withInput();

        }

//        // Validácia vstupných údajov
//        $request->validate([
//            'name' => 'required|string|max:255',
//            'location' => 'required|string|max:255',
//            'capacity' => 'required|numeric|max:5',
//        ]);

        // Vytvorenie používateľa a uloženie do databázy
        Rooms::create([
            'name' => $request->input('name'),
            'location' => $request->input('location'),
            'capacity' => $request->input('capacity'),
        ]);

        return redirect()->route('rooms.index')
            ->with('success', 'New room "' . $request->input('name') . '" was created !');
    }
}
