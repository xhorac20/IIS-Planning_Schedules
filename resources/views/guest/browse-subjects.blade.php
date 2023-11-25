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
                    <li> - <a href="{{ route('subjects.show', $subject) }}">{{ $subject->name }}</a>
                        {{ $subject->description }}
                        @if (auth()->user()->isStudent())
                            <form action="{{ route('schedule.add', $subject->id) }}" method="POST"
                                  style="display: inline;">
                                @csrf
                                <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                <button type="submit" class="btn-send">Pridať do rozvrhu</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
