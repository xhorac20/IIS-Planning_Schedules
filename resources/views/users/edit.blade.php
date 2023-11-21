@extends('layouts.app')

@section('title', 'Upravit uživatele')

@section('content')
    <h1>Upravit uživatele: {{ $user->name }}</h1>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <label for="name">Jméno:</label>
        <input type="text" name="name" id="name" value="{{ $user->name }}" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="{{ $user->email }}" required>

        {{-- Přidejte další pole podle potřeby --}}

        <button type="submit">Aktualizovat uživatele</button>
    </form>
@endsection

