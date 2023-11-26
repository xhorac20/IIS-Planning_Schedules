@extends('layouts.app')

@section('title', 'Vytvořit nového uživatele')

@section('content')
    <script>
        $(document).ready(function () {
            // Ked sa nacita stranka prida sa element
            $('#Alert').fadeIn();

            // Po 15 sekundach sa zavola funkcia na skrytie alertu
            setTimeout(function () {
                hideAlert();
            }, 15000); // 15 sekund
        });

        function hideAlert() {
            // Trieda s animaciou vystupu
            $('#Alert').fadeOut();

            // skončení animácie sa element odstrani
            setTimeout(function () {
                $('#Alert').remove();
            }, 1000);
        }
    </script>

    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container">
            <div class="event-title">
                <h1>Create new user</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <form method="POST" action="{{ route('users.store') }}">
                @csrf
                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Name" required>

                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Email" required>

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
                <button type="button" onclick="location.href = '{{ route('users.index') }}'">Cancel</button>
            </form>
        </div>
    </div>

@endsection
