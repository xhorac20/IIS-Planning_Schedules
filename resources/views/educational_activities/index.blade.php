@extends('layouts.app')

@section('title', 'Seznam výukových aktivit')

@section('content')
    <h1>Seznam výukových aktivit</h1>

    <a href="{{ route('educational-activities.create') }}">Vytvořit novou aktivitu</a>

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
