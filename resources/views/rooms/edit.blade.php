@extends('layouts.app')

@section('title', 'Upravit místnost')

@section('content')
    <h1>Upravit místnost: {{ $room->name }}</h1>

    <form method="POST" action="{{ route('rooms.update', $room) }}">
        @csrf
        @method('PUT')

        <label for="name">Název místnosti:</label>
        <input type="text" name="name" id="name" value="{{ $room->name }}" required>

        <label for="location">Lokace:</label>
        <input type="text" name="location" id="location" value="{{ $room->location }}" required>

        <label for="capacity">Kapacita:</label>
        <input type="number" name="capacity" id="capacity" value="{{ $room->capacity }}" required>

        <button type="submit">Aktualizovat místnost</button>
    </form>
@endsection
