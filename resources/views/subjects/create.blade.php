@extends('layouts.app')

@section('title', 'Vytvořit nový předmět')

@section('content')
    <h1>Vytvořit nový předmět</h1>

    <form method="POST" action="{{ route('subjects.store') }}">
        @csrf
        <label for="code">Kód:</label>
        <input type="text" name="code" id="code" required>

        <label for="name">Název:</label>
        <input type="text" name="name" id="name" required>

        <label for="annotation">Anotace:</label>
        <textarea name="annotation" id="annotation"></textarea>

        <label for="credits">Počet kreditů:</label>
        <input type="number" name="credits" id="credits" required>

        <button type="submit">Vytvořit předmět</button>
    </form>
@endsection
