@extends('layouts.app')

@section('title', 'Správa výukových aktivít')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="flex-grow-1">
            <div class="event-title-manage event-title">
                <h1>Správa výukových aktivít</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('educational-activities.create') }}"
                   class="create-button create-activity-button btn-success btn-dark-blue">Pridať novú aktivitu</a>
            </div>

            @foreach ($subjects as $subject)
                <div class="card active-card">
                    <div class="card-header">
                        <h2>{{ $subject->name }} ({{ $subject->code }})</h2>
                    </div>
                    <div class="card-body">

                        {{-- Ucitelia --}}
                        <h4>Učitelia:</h4>
                        <ul>
                            {{-- Odstránenie učiteľa --}}
                            @foreach ($assignedTeachers[$subject->id] as $teacher)
                                <form
                                    action="{{ route('subject.remove-teacher', ['subject' => $subject->id, 'teacher' => $teacher->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-dark">Odstrániť {{ $teacher->name }}</button>
                                </form>
                            @endforeach
                        </ul>

                        {{-- Pridanie učiteľa --}}
                        <form action="{{ route('subject.add-teacher', ['subject' => $subject->id]) }}" method="POST">
                            @csrf
                            <label for="teacher_id">Pridať učiteľa:</label>
                            <select name="teacher_id" id="teacher_id" required>
                                @foreach ($availableTeachers as $availableTeacher)
                                    @if (!in_array($availableTeacher->id, $subject->teacher_ids ?? []))
                                        <option
                                            value="{{ $availableTeacher->id }}">{{ $availableTeacher->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            <button type="submit" class="btn-send">Pridať</button>
                        </form>

                        <h4>Výukové aktivity:</h4>
                        <ul class="vyuka">
                            @foreach ($activities[$subject->id] as $activity)
                                <li>{{ $activity->type }} - trvanie: {{ $activity->duration }} minút
                                    @if($activity->teacher)
                                        Vyučujúci: {{ $activity->teacher->name }}
                                    @else
                                        Vyučujúci:
                                    @endif
                                    {{-- další informace o aktivitě nebo odkazy na úpravu --}}

                                    {{-- Formulár pre pridanie --}}
                                    <form action="{{ route('educational-activities.edit', $activity->id) }}"
                                          method="get" style="display: inline;">
                                        <button type="submit" class="btn-send">Edit</button>
                                    </form>

                                    {{-- Formulár pre odstránenie --}}
                                    <form method="POST"
                                          action="{{ route('educational-activities.destroy', $activity->id) }}"
                                          class="mt-3" style="display: inline;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-remove">Delete</button>
                                    </form>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
