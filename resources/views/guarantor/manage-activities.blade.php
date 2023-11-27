@extends('layouts.app')

@section('title', 'Správa výukových aktivít')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="flex-grow-1">
            <h2 class="text-center">Správa výukových aktivít</h2>

            @foreach ($subjects as $subject)
                <div class="card my-3">
                    <div class="card-header">
                        {{ $subject->name }} ({{ $subject->code }})
                    </div>
                    <div class="card-body">

                        {{-- Ucitelia --}}
                        <h5>Učitelia:</h5>
                        <ul>
                            {{-- Odstránenie učiteľa --}}
                            @foreach ($assignedTeachers[$subject->id] as $teacher)
                                <form
                                    action="{{ route('subject.remove-teacher', ['subject' => $subject->id, 'teacher' => $teacher->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Odstrániť {{ $teacher->name }}</button>
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

                        <h5>Výukové aktivity:</h5>
                        <ul>
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
            <a href="{{ route('educational-activities.create') }}" class="btn btn-success">Pridať novú aktivitu</a>
        </div>
    </div>
@endsection
