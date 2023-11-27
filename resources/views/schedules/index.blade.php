@extends('layouts.app')

@section('title', 'Seznam rozvrhů')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container profile-container">
            <div class="event-title-manage event-title">
                <h1>Seznam rozvrhů</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('schedules.create') }}" class="create-button btn-dark-blue">Vytvořit rozvrh</a>
            </div>
            <ul>
                @foreach ($schedules as $schedule)
                    <li>
                        Rozvrh {{ $schedule->id }}
                        <a href="{{ route('schedules.show', $schedule) }}">Zobrazit</a>
                        <a href="{{ route('schedules.edit', $schedule) }}">Upravit</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
