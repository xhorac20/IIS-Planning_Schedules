@extends('layouts.app')

@section('title', 'Upravit rozvrh')

@section('content')
    <h1>Upravit rozvrh: {{ $schedule->id }}</h1>

    <form method="POST" action="{{ route('schedules.update', $schedule) }}">
        @csrf
        @method('PUT')

        <label for="educational_activity_id">Výuková aktivita:</label>
        <select name="educational_activity_id" id="educational_activity_id" required>
            {{-- Seznam výukových aktivit s výběrem aktuální hodnoty --}}
        </select>

        <label for="room_id">Místnost:</label>
        <select name="room_id" id="room_id" required>
            {{-- Seznam místností s výběrem aktuální hodnoty --}}
        </select>

        <label for="start_time">Začátek:</label>
        <input type="time" name="start_time" id="start_time" value="{{ $schedule->start_time }}" required>

        <label for="end_time">Konec:</label>
        <input type="time" name="end_time" id="end_time" value="{{ $schedule->end_time }}" required>

        <button type="submit">Aktualizovat rozvrh</button>
    </form>
@endsection
