@extends('layouts.app')

@section('title', 'Detail rozvrhu')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container profile-container">
            <div class="event-title-manage event-title">
                <h1>Rozvrh č. {{ $schedule->id }}</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('schedules.edit', $schedule) }}" class="create-button btn-dark-blue">Upravit</a>
            </div>
            <p>Výuková aktivita: {{ $schedule->educational_activity_id }}</p>
            <p>Místnost: {{ $schedule->room_id }}</p>
            <p>Čas: {{ $schedule->start_time }} - {{ $schedule->end_time }}</p>
        </div>
    </div>

@endsection
