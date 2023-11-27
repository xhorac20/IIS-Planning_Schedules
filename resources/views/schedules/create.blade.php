@extends('layouts.app')

@section('title', 'Vytvořit nový rozvrh')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavný obsah -->
        <div class="flex-grow-1">
            <div class="event-title-manage event-title">
                <h1>Vytvorenie Nového Rozvrhu</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <form method="POST" action="{{ route('schedules.store') }}">
                @csrf

                {{-- Presnu dat --}}
                <input type="hidden" name="educational_activity_id" value="{{ $currentActivity->id }}">

                {{-- Predmet a typ aktivity --}}
                <div class="form-group">
                    <label for="activity">Predmet a Typ Aktivity:</label>
                    <input type="text" id="activity" value="{{ $subjectName }} - {{ $activityType }}" disabled>
                </div>

                {{-- Miestnosť --}}
                <div class="form-group">
                    <label for="room_id">Miestnosť:</label>
                    <select name="room_id" id="room_id" required>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }} - Kapacita: {{ $room->capacity }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Vyučujúci --}}
                <div class="form-group">
                    <label for="instructor_id">Vyučujúci:</label>
                    <select name="instructor_id" id="instructor_id" required>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Deň --}}
                <div class="form-group">
                    <label for="day">Deň:</label>
                    <select name="day" id="day" required>
                        <option value="Po">Pondelok</option>
                        <option value="Ut">Utorok</option>
                        <option value="St">Streda</option>
                        <option value="Št">Štvrtok</option>
                        <option value="Pi">Piatok</option>
                    </select>
                </div>

                {{-- Čas začiatku a konca --}}
                <div class="form-group">
                    <label for="start_time">Čas Začiatku:</label>
                    <input type="time" name="start_time" id="start_time" min="07:00" max="19:00" required>
                </div>
                <div class="form-group">
                    <label for="end_time">Čas Konca:</label>
                    <input type="time" name="end_time" id="end_time" min="07:00" max="20:00" required>
                </div>

                <button type="submit" class="btn btn-primary">Vytvoriť Rozvrh</button>
            </form>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const startTimeInput = document.getElementById('start_time');
        const endTimeInput = document.getElementById('end_time');
        const duration = {{ $currentActivity->duration }}; // Doba trvania v minútach

        // Funkcia na aktualizáciu času konca
        function updateEndTime() {
            if (startTimeInput.value) {
                const startTime = new Date('1970-01-01T' + startTimeInput.value + 'Z');
                const endTime = new Date(startTime.getTime() + duration * 60000); // Pridajte dobu trvania

                // Formátujte čas konca do správneho formátu
                const endHour = endTime.getUTCHours().toString().padStart(2, '0');
                const endMinute = endTime.getUTCMinutes().toString().padStart(2, '0');
                endTimeInput.value = endHour + ':' + endMinute;
            }
        }

        // Počúvajte zmeny v poli času začiatku
        startTimeInput.addEventListener('change', updateEndTime);

        // Aktualizujte čas konca pri načítaní stránky
        updateEndTime();
    });
</script>
