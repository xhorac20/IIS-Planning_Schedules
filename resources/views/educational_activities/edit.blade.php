@extends('layouts.app')

@section('title', 'Upravit výukovou aktivitu')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="flex-grow-1">
            <div class="event-title-manage event-title">
                <h1 class="text-center">Upravit výukovou aktivitu: {{ $educationalActivity->type }}</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <div class="card active-card">
                <div class="card-body">
                    <form method="POST" action="{{ route('educational-activities.update', $educationalActivity) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-header">
                            <label for="subject">Předmět:</label>
                            <input type="text" id="subject" value="{{ $educationalActivity->subject->name }}" disabled>
                        </div>

                        <div class="form-group">
                            <label for="type">Typ aktivity:</label>
                            <select name="type" id="type" required>
                                <option
                                    value="Prednáška" {{ $educationalActivity->type == 'Prednáška' ? 'selected' : '' }}>
                                    Prednáška
                                </option>
                                <option
                                    value="Cvičenie" {{ $educationalActivity->type == 'Cvičenie' ? 'selected' : '' }}>
                                    Cvičenie
                                </option>
                                <option value="Skúška" {{ $educationalActivity->type == 'Skúška' ? 'selected' : '' }}>
                                    Skúška
                                </option>
                                <option value="Iné" {{ $educationalActivity->type == 'Iné' ? 'selected' : '' }}>Iné
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="duration">Dĺžka trvania (minúty):</label>
                            <input type="number" name="duration" id="duration"
                                   value="{{ $educationalActivity->duration }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="repetition">Opakovanie:</label>
                            <select name="repetition" id="repetition" required onchange="checkRepetition(this.value)">
                                <option
                                    value="Každý" {{ $educationalActivity->repetition == 'Každý' ? 'selected' : '' }}>
                                    Každý
                                </option>
                                <option
                                    value="Párny" {{ $educationalActivity->repetition == 'Párny' ? 'selected' : '' }}>
                                    Párny
                                </option>
                                <option
                                    value="Nepárny" {{ $educationalActivity->repetition == 'Nepárny' ? 'selected' : '' }}>
                                    Nepárny
                                </option>
                                <option
                                    value="Jednorázovo" {{ $educationalActivity->repetition == 'Jednorázovo' ? 'selected' : '' }}>
                                    Jednorázovo
                                </option>
                            </select>
                        </div>

                        <div class="form-group" id="eventDateGroup" style="display: none;">
                            <label for="event_date">Dátum konania:</label>
                            <input type="date" name="event_date" id="event_date"
                                   value="{{ $educationalActivity->event_date }}"
                                   min="{{ now()->toDateString() }}">
                        </div>

                        {{-- Miestnosť --}}
                        <div class="form-group">
                            <label for="room_id">Miestnosť:</label>
                            <select name="room_id" id="room_id">
                                @foreach ($rooms as $room)
                                    <option
                                        value="{{ $room->id }}" {{ $educationalActivity->room_id == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} - Kapacita: {{ $room->capacity }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Vyučujúci --}}
                        <div class="form-group">
                            <label for="teacher_id">Vyučujúci:</label>
                            <select name="teacher_id" id="teacher_id">
                                @foreach ($teachers as $teacher)
                                    <option
                                        value="{{ $teacher->id }}" {{ $educationalActivity->teacher_id == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <h5>Vyhovujúce dni a Hodiny:</h5>
                        {{-- Vyžadované dni a časy --}}
                        {{-- Rozhranie pre zadávanie preferovaných dní a časov --}}
                        @foreach (['Po', 'Ut', 'St', 'Št', 'Pi'] as $day)
                            <div class="form-group">
                                <label for="preferred_time_{{ $day }}_start">{{ $day }} Od:</label>
                                <input type="time" name="preferred_time[{{ $day }}][start]"
                                       id="preferred_time_{{ $day }}_start"
                                       value="{{ $preferredDayTime[$day]['start'] ?? '' }}" min="07:00" max="20:00">

                                <label for="preferred_time_{{ $day }}_end">Do:</label>
                                <input type="time" name="preferred_time[{{ $day }}][end]"
                                       id="preferred_time_{{ $day }}_end"
                                       value="{{ $preferredDayTime[$day]['end'] ?? '' }}" min="07:00" max="20:00">
                            </div>
                        @endforeach
                        <button class="btn-send" type="submit">Aktualizovat aktivitu</button>
                    </form>

                    {{-- Rozvrh --}}
                    {{--<a href="{{ route('manage-activities.manage-schedule', $educationalActivity->id) }}" class="btn btn-primary">Spravovať Rozvrh</a>--}}

                    {{-- Formulár pre odstránenie --}}
                    <form method="POST" action="{{ route('educational-activities.destroy', $educationalActivity) }}">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-remove">Odstrániť aktivitu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function checkRepetition(value) {
        if (value === 'Jednorázovo') {
            document.getElementById('eventDateGroup').style.display = 'block';
        } else {
            document.getElementById('eventDateGroup').style.display = 'none';
        }
    }

    // Inicializácia po načítaní stránky
    window.onload = function () {
        checkRepetition(document.getElementById('repetition').value);
    };
</script>
