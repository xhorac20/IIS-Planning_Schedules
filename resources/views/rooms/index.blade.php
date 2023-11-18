@extends('layouts.app')

@section('title', 'Seznam místností')

@section('content')
    <h1>Seznam místností</h1>

    <a href="{{ route('rooms.create') }}">Vytvořit novou místnost</a>

    <ul>
        @foreach ($rooms as $room)
            <li>
                {{ $room->name }}
                <a href="{{ route('rooms.show', $room) }}">Zobrazit</a>
                <a href="{{ route('rooms.edit', $room) }}">Upravit</a>
            </li>
        @endforeach
    </ul>
@endsection
