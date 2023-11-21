@extends('layouts.app')

@section('title', 'Detail rozvrhu')

@section('content')
    <h1>Rozvrh č. {{ $schedule->id }}</h1>
    <p>Výuková aktivita: {{ $schedule->educational_activity_id }}</p>
    <p>Místnost: {{ $schedule->room_id }}</p>
    <p>Čas: {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>

    <a href="{{ route('schedules.edit', $schedule) }}">Upravit</a>
@endsection
