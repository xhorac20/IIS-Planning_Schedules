@extends('layouts.app')

@section('title', 'Správa rozvrhů')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        {{-- TODO CSS, simplify form, add schedule DELETION --}}
        @php
            $localized = [
                'monday' => 'Pondělí',
                'tuesday' => 'Úterý',
                'wednesday' => 'Středa',
                'thursday' => 'Čtvrtek',
                'friday' => 'Pátek'
            ];
        @endphp
        <div class="flex-grow-1">
            <h2 class="text-center">Správa rozvrhů</h2>
            @if(session('success'))
                <h4 class="text-center">{{ session('success') }}</h4>
            @endif
            @if(session('failure'))
                <h4 class="text-center" style="color: firebrick">{{ session('failure') }}</h4>
            @endif
            <form action="{{ route('manage-schedules.edit') }}" method="POST" id="schedule">
                @csrf
                <div>
                    <h4>Výběr výukové aktivity:</h4>
                    <table style="border: 1px solid black">
                        <thead>
                        <tr>
                            <th>Volba</th>
                            <th>Název předmětu</th>
                            <th>Typ</th>
                            <th>Délka</th>
                            <th>Opakování</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td><input type="radio" id="educational_activity_id" name="educational_activity_id" value="{{ $activity->id }}" onclick="document.getElementById('duration').value = {{ $activity->duration }}"><label for="educational_activity_id"></label></td>
                                <td>{{ $activity->subject->name }}</td>
                                <td>{{ $activity->type }}</td>
                                <td>{{ $activity->duration }}</td>
                                <td>{{ $activity->repetition }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                </div>
                <div>
                    <h4>Výběr místnosti:</h4>
                    <table style="border: 1px solid black">
                        <thead>
                        <tr>
                            <th>Volba</th>
                            <th>Kód místnosti</th>
                            <th>Kapacita</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($rooms as $room)
                            <tr>
                                <td><input type="radio" id="room_id" name="room_id" value="{{ $room->id }}"><label for="room_id"></label></td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->capacity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                </div>
                <div>
                    <table style="border: 1px solid black">
                        <h4>Výběr vyučujícího:</h4>
                        <thead>
                        <tr>
                            <th>Volba</th>
                            <th>Vyučující</th>
                            <th>Den</th>
                            <th>Od - do</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($requirements as $requirement)
                            <tr>
                                <td><input type="radio" id="instructor_id" name="instructor_id" value="{{ $requirement->instructor->id }}"><label for="instructor_id"></label></td>
                                <td>{{ $requirement->instructor->name }}</td>
                                <td>{{ $localized[$requirement->day] }}</td>
                                <td>{{ date('H:i', strtotime($requirement->start_time)) }} - {{ date('H:i', strtotime($requirement->end_time)) }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table><br>
                </div>
                <label for="day">Den:</label>
                <select name="day" id="day">
                    <option value="Po">Pondělí</option>
                    <option value="Ut">Úterý</option>
                    <option value="St">Středa</option>
                    <option value="Št">Čtvrtek</option>
                    <option value="Pi">Pátek</option>
                </select><br>

                <input type="hidden" name="duration" id="duration">

                <label for="start_time">Začátek aktivity:</label>
                <select name="start_time" id="start_time">
                    @for ($hour = 8; $hour <= 20; $hour++)
                        <option value="{{ sprintf('%02d:00', $hour) }}">{{ sprintf('%02d:00', $hour) }}</option>
                    @endfor
                </select><br>

                <h4 class="text-center" id="incomplete" style="display: none; color: firebrick">Chyba: před uložením je nutné zvolit výukovou aktivitu, místnost a vyučujícího</h4>
                <button type="submit" class="btn-send">Uložit rozvrhové aktivity</button><br><br>
            </form>
        </div>
        <script>
            // verify that required inputs are provided
            document.getElementById('schedule').addEventListener('submit', function(event)
            {
                let valid = true;
                ['educational_activity_id', 'room_id', 'instructor_id'].forEach(function(name)
                {
                    if (!document.querySelector('input[name="' + name + '"]:checked'))
                    {
                        valid = false;
                    }
                });
                if (!valid)
                {
                    event.preventDefault();
                    document.getElementById('incomplete').style.display = 'block';
                }
            });
        </script>
@endsection
