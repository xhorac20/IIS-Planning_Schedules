@extends('layouts.app')

@section('title', 'Detail uživatele')

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

        <div class="user-container profile-container">
            <div class="event-title-manage event-title">
                <h1>User Profile</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('users.edit', $user) }}" class="create-button btn-dark-blue">Edit</a>
            </div>
            <div class="card">
                <h2>{{ $user->name }}</h2>
                <p class="profile-role">{{ $user->role }}</p>
                <hr>
                <p>{{ $user->email }}</p>
                {{--Další detaily uživatele --}}
            </div>
            <div class="card">
                <h3>Other information about the user</h3>
                <hr>
                <p>More information HERE</p>
                {{--Další detaily uživatele --}}
            </div>
        </div>
    </div>
@endsection
