@extends('layouts.app')

@section('title', 'Vytvořit novou místnost')

@section('content')
    <h1>Vytvořit novou místnost</h1>

    <form method="POST" action="{{ route('rooms.store') }}">
        @csrf
        <label for="name">Název místnosti:</label>
        <input type="text" name="name" id="name" required>

        <label for="location">Lokace:</label>
        <input type="text" name="location" id="location" required>

        <label for="capacity">Kapacita:</label>
        <input type="number" name="capacity" id="capacity" required>

        <button type="submit">Vytvořit místnost</button>
    </form>
@endsection
