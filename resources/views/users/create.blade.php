@extends('layouts.app')

@section('title', 'Vytvořit nového uživatele')

@section('content')
    <div class="user-container">
        <div class="event-title">
            <h1>Create new user</h1>
        </div>
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <label for="name"></label>
            <input type="text" name="name" id="name"  placeholder="Name" required>

            <label for="email"></label>
            <input type="email" name="email" id="email"  placeholder="Email" required>

            <label for="password"></label>
            <input type="password" name="password" id="password" placeholder="Password" required>

            <label for="role"></label>
            <label>
                <select name="role" required>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                    <option value="garant">Garant</option>
                    <option value="teacher">Teacher</option>
                    <option value="scheduler">Scheduler</option>
                    <option value="student">Student</option>
                </select>
            </label>

            <button type="submit">Create User</button>
{{--         <a href="{{ route('home') }}">Cancel</a>--}}
            <button type="button" onclick="location.href = '{{ route('users.index') }}'">Cancel</button>
        </form>
    </div>

@endsection


@section('scripts')
    <script>
        function cancelCreateUser() {
            window.location.href = "{{ route('users.index') }}";
        }
    </script>
@endsection
