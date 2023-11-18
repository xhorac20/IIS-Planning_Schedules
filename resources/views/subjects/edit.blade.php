@extends('layouts.app')

@section('title', 'Upravit předmět')

@section('content')
    <h1>Upravit předmět: {{ $subject->name }}</h1>

    <form method="POST" action="{{ route('subjects.update', $subject) }}">
        @csrf
        @method('PUT')

        <label for="code">Kód:</label>
        <input type="text" name="code" id="code" value="{{ $subject->code }}" required>

        <label for="name">Název:</label>
        <input type="text" name="name" id="name" value="{{ $subject->name }}" required>

        <label for="annotation">Anotace:</label>
        <textarea name="annotation" id="annotation">{{ $subject->annotation }}</textarea>

        <label for="credits">Počet kreditů:</label>
        <input type="number" name="credits" id="credits" value="{{ $subject->credits }}" required>

        <button type="submit">Aktualizovat předmět</button>
    </form>
@endsection
