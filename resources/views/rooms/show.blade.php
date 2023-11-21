@extends('layouts.app')

@section('title', 'Detail místnosti')

@section('content')
    <h1>Místnost: {{ $room->name }}</h1>
    <p>Lokace: {{ $room->location }}</p>
    <p>Kapacita: {{ $room->capacity }}</p>

    <a href="{{ route('rooms.edit', $room) }}">Upravit</a>
@endsection
