@extends('layouts.app')

@section('title', 'Správa rozvrhů')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        {{-- TODO CSS --}}
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
            @if(session('successRemove'))
                <input type="checkbox" id="toggle" name="toggle" onchange="document.getElementById('removeSchedule').style.display = this.checked ? 'block' : 'none'" checked>
            @else
                <input type="checkbox" id="toggle" name="toggle" onchange="document.getElementById('removeSchedule').style.display = this.checked ? 'block' : 'none'">
            @endif

            <label for="toggle">Zobrazit stávající aktivity (odebrání z rozvrhu)</label>
            <form action="{{ route('manage-schedules.remove') }}" method="POST" id="removeSchedule" style="display: none">
                <h3>Odebrání aktivit z rozvrhu:</h3>
                @if(session('successRemove'))
                    <h4 class="text-center">{{ session('successRemove') }}</h4>
                @endif
                @csrf
                <div>
                    <table style="border: 1px solid black">
                        <thead>
                        <tr>
                            <th>Volba</th>
                            <th>Předmět</th>
                            <th>Typ</th>
                            <th>Vyučující</th>
                            <th>Místnost</th>
                            <th>Den</th>
                            <th>Začátek</th>
                            <th>Konec</th>
                            <th>Opakování</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td><input type="checkbox" id="schedules_id" name="schedules_id[]" value="{{ $schedule->id }}"><label for="schedules_id"></label></td>
                                    <td>{{ $schedule->educationalActivity->subject->name }}</td>
                                    <td>{{ $schedule->educationalActivity->type }}</td>
                                    <td>{{ $schedule->instructor->name }}</td>
                                    <td>{{ $schedule->room->name }}</td>
                                    <td>{{ $schedule->day }}</td>
                                    <td>{{ $schedule->start_time }}</td>
                                    <td>{{ $schedule->end_time }}</td>
                                    <td>{{ $schedule->educationalActivity->repetition }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn-send">Odebrat aktivity z rozvrhu</button><br><br>
                    <hr><br>
                </div>
            </form>

            <h3>Přídání aktivity do rozvrhu:</h3>
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
                    @php
                        $reqs = [];
                        foreach($requirements as $requirement)
                        {
                            $reqs[$requirement->instructor->id]['name'] = $requirement->instructor->name;
                            $reqs[$requirement->instructor->id]['req'][$requirement->day] = $requirement;
                        }
                    @endphp
                    <table style="border: 1px solid black">
                        <h4>Výběr vyučujícího:</h4>
                        <thead>
                        <tr>
                            <th>Volba</th>
                            <th>Vyučující</th>
                            <th>Pondělí</th>
                            <th>Úterý</th>
                            <th>Středa</th>
                            <th>Čtvrtek</th>
                            <th>Pátek</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reqs as $id => $data)
                            <tr>
                                <td><input type="radio" id="instructor_id" name="instructor_id" value="{{ $id }}"><label for="instructor_id"></label></td>
                                <td>{{ $data['name'] }}</td>
                                @foreach(['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day)
                                    <td style="padding: 5px">
                                        @if(isset($data['req'][$day]))
                                            @php
                                                $req = $data['req'][$day];
                                            @endphp
                                            {{ date('H:i', strtotime($req->start_time)) }} - {{ date('H:i', strtotime($req->end_time)) }}
                                        @endif
                                    </td>
                                @endforeach
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
            if(document.getElementById('toggle').checked)
            {
                document.getElementById('removeSchedule').style.display = 'block';
            }
            // verify that required inputs are provided
            document.getElementById('schedule').addEventListener('submit', function(event)
            {
                let valid = true;
                ['educational_activity_id', 'room_id', 'instructor_id'].forEach(function(name)
                {
                    if(!document.querySelector('input[name="' + name + '"]:checked'))
                    {
                        valid = false;
                    }
                });
                if(!valid)
                {
                    event.preventDefault();
                    document.getElementById('incomplete').style.display = 'block';
                }
            });
        </script>
@endsection
