@extends('layouts.app')

@section('title', 'Seznam rozvrhů')

@section('content')
    <div class="event-title-manage event-title">
        <h1>Seznam rozvrhů</h1>
        @if(session('success') || session('status'))
            <div class="alert" id="Alert">
                {{ session('success') }}
                {{ session('status') }}
            </div>
        @endif
    </div>
    <a href="{{ route('schedules.create') }}">Vytvořit nový rozvrh</a>

    <ul>
        @foreach ($schedules as $schedule)
            <li>
                Rozvrh {{ $schedule->id }}
                <a href="{{ route('schedules.show', $schedule) }}">Zobrazit</a>
                <a href="{{ route('schedules.edit', $schedule) }}">Upravit</a>
            </li>
        @endforeach
    </ul>
@endsection
