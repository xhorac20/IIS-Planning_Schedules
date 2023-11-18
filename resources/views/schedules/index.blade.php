@extends('layouts.app')

@section('title', 'Seznam rozvrhů')

@section('content')
    <h1>Seznam rozvrhů</h1>

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
