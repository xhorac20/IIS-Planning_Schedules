@extends('layouts.app')

@section('title', 'Seznam výukových aktivit')

@section('content')
    <div class="event-title-manage event-title">
        <h1>Seznam výukových aktivit</h1>
        @if(session('success') || session('status'))
            <div class="alert" id="Alert">
                {{ session('success') }}
                {{ session('status') }}
            </div>
        @endif
        <a href="{{ route('educational-activities.create') }}" class="create-button create-sub-button btn-dark-blue">Vytvořit novou aktivitu</a>
    </div>

    <ul>
        @foreach ($educationalActivities as $activity)
            <li>
                {{ $activity->type }} - {{ $activity->subject->name }}
                <a href="{{ route('educational-activities.show', $activity) }}">Zobrazit</a>
                <a href="{{ route('educational-activities.edit', $activity) }}">Upravit</a>
            </li>
        @endforeach
    </ul>
@endsection
