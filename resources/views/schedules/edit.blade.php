@extends('layouts.app')

@section('title', 'Upravit rozvrh')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="flex-grow-1">
            <h1 class="text-center">Upravit Rozvrh Pre: {{ $schedule->educationalActivity->subject->name }}
                - {{ $schedule->educationalActivity->type }}</h1>

            <form method="POST" action="{{ route('schedules.update', $schedule->id) }}">
                @csrf
                @method('PUT')

                {{-- Predmet a typ aktivity --}}
                <div class="form-group">
                    <label for="activity">Predmet a Typ Aktivity:</label>
                    <input type="text" id="activity"
                           value="{{ $schedule->educationalActivity->subject->name }} - {{ $schedule->educationalActivity->type }}"
                           disabled>
                </div>

                {{-- Miestnosť --}}
                <div class="form-group">
                    <label for="room_id">Miestnosť:</label>
                    <select name="room_id" id="room_id" required>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ $room->id == $schedule->room_id ? 'selected' : '' }}>
                                {{ $room->name }} - Kapacita: {{ $room->capacity }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Vyučujúci --}}
                <div class="form-group">
                    <label for="instructor_id">Vyučujúci:</label>
                    <select name="instructor_id" id="instructor_id" required>
                        @foreach ($teachers as $teacher)
                            <option
                                value="{{ $teacher->id }}" {{ $teacher->id == $schedule->instructor_id ? 'selected' : '' }}>
                                {{ $teacher->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Deň --}}
                <div class="form-group">
                    <label for="day">Deň:</label>
                    <select name="day" id="day" required>
                        @foreach (['Po', 'Ut', 'St', 'Št', 'Pi'] as $day)
                            <option
                                value="{{ $day }}" {{ $schedule->day == $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Čas začiatku a konca --}}
                <div class="form-group">
                    <label for="start_time">Čas Začiatku:</label>
                    <input type="time" name="start_time" id="start_time"
                           value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}" min="07:00"
                           max="19:00" required>
                </div>
                <div class="form-group">
                    <label for="end_time">Čas Konca:</label>
                    <input type="time" name="end_time" id="end_time"
                           value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}"
                           min="07:00" max="20:00" required>
                </div>

                <button type="submit" class="btn btn-primary">Aktualizovať Rozvrh</button>
            </form>


        </div>
    </div>
@endsection

