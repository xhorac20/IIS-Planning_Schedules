@extends('layouts.app')

@section('title', 'Prechádzanie Predmetov')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah - Zoznam predmetov -->
        <div class="flex-grow-1">
            <div class="event-title event-title-manage">
                <h1>Zoznam Predmetov</h1>
                @if(session('success') || session('status'))
                    <div class="alert-center alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <ul>
                @foreach ($subjects as $subject)
                    <li class="activities" onclick="location.href = '{{ route('subjects.show', $subject->id) }}'">
                        <a href="{{ route('subjects.show', $subject) }}">{{ $subject->name }}</a>
                        <p class="dots">{{ $subject->description }}</p>
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
