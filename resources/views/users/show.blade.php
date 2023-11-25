@extends('layouts.app')

@section('title', 'Detail uživatele')

@section('content')
    <div class="user-container">
        <div class="event-title-manage event-title">
            <h1>User Profile</h1>
            <a href="{{ route('users.edit', $user) }}" class="create-button btn-dark-blue">Upravit</a>
        </div>
        <div class="card">
            <h2>{{ $user->name }}</h2>
            <p class="profile-role">{{ $user->role }}</p>
            <hr>
            <p>{{ $user->email }}</p>
            {{--Další detaily uživatele --}}
        </div>


    </div>
@endsection
