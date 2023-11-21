@extends('layouts.app')

@section('title', 'Vytvořit nového uživatele')

@section('content')
    <h1>Vytvořit nového uživatele</h1>

    <form method="POST" action="{{ route('users.store') }}">
        @csrf
        <label for="name">Jméno:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Heslo:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Vytvořit uživatele</button>
    </form>
@endsection
