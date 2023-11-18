@extends('layouts.app')

@section('title', 'Seznam uživatelů')

@section('content')
    <h1>Seznam uživatelů</h1>

    <a href="{{ route('users.create') }}">Vytvořit nového uživatele</a>

    <ul>
        @foreach ($users as $user)
            <li>
                {{ $user->name }}
                <a href="{{ route('users.show', $user) }}">Zobrazit</a>
                <a href="{{ route('users.edit', $user) }}">Upravit</a>
            </li>
        @endforeach
    </ul>
@endsection
