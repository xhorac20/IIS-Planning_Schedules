@extends('layouts.app')

@section('title', 'Prechádzanie Predmetov')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah - Zoznam predmetov -->
        <div class="flex-grow-1">
            <div class="event-title">
                <h2 class="text-center">Zoznam Predmetov</h2>
            </div>

            <ul>
                @foreach ($subjects as $subject)
                    <li>
                        <a href="{{ route('subjects.show', $subject) }}">{{ $subject->name }}</a>
                        - {{ $subject->description }}
                        @auth
                            @if (auth()->user()->isStudent() || Auth::user()->isAdmin())
                                @if (!\App\Models\StudentSchedule::isAddedToStudentSchedule($subject->id))
                                    <form action="{{ route('student-schedule.add', $subject->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn-send">Pridať do rozvrhu</button>
                                    </form>
                                @else
                                    <form action="{{ route('student-schedule.remove', $subject->id) }}" method="POST"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-remove">Odstrániť z rozvrhu</button>
                                    </form>
                                @endif
                            @endif
                        @endauth
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
