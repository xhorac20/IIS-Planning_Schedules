@extends('layouts.app')

@section('title', 'Vytvořit nový rozvrh')

@section('content')
    <h1>Vytvořit nový rozvrh</h1>

    <form method="POST" action="{{ route('schedules.store') }}">
        @csrf
        <label for="educational_activity_id">Výuková aktivita:</label>
        <select name="educational_activity_id" id="educational_activity_id" required>
            {{-- Zde byste měli načíst seznam výukových aktivit --}}
        </select>

        <label for="room_id">Místnost:</label>
        <select name="room_id" id="room_id" required>
            {{-- Zde byste měli načíst seznam místností --}}
        </select>

        <label for="start_time">Začátek:</label>
        <input type="time" name="start_time" id="start_time" required>

        <label for="end_time">Konec:</label>
        <input type="time" name="end_time" id="end_time" required>

        <button type="submit">Vytvořit rozvrh</button>
    </form>
@endsection
