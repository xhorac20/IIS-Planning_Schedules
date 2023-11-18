@extends('layouts.app')

@section('title', 'Detail uživatele')

@section('content')
    <h1>{{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    {{-- Zde můžete přidat další detaily uživatele --}}

    <a href="{{ route('users.edit', $user) }}">Upravit</a>
@endsection
