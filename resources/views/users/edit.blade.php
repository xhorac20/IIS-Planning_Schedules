@extends('layouts.app')

@section('title', 'Upravit uživatele')

@section('content')
    <div class="user-container">
        <div class="event-title">
            <h1>Edit User: {{ $user->name }}</h1>
        </div>

        <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="borders">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ $user->name }}" required>
            </div>
            <div class="borders">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" required>
            </div>
            <div class="borders borders-role">
                <label for="name">
                    Role:
                    <select name="role" id="role">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="garant" {{ $user->role == 'garant' ? 'selected' : '' }}>Garant</option>
                        <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                        <option value="scheduler" {{ $user->role == 'scheduler' ? 'selected' : '' }}>Scheduler</option>
                        <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                    </select>
                </label>
            </div>
            <div class="borders change-password">
                <label for="password">Change Password</label>
                <hr>
                <input type="password" name="password" id="password" placeholder="Set New Password" required>
            </div>

            <div class="buttons">
                <button type="submit">Save</button>
                <button type="button" onclick="location.href = '{{ route('users.index') }}'">Cancel</button>
            </div>
        </form>
    </div>
@endsection

