@extends('layouts.app')

@section('title', 'Detail Předmětu')

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
                <h1>Subject Detail</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('subjects.edit', $subject) }}" class="create-button btn-dark-blue">Edit</a>
            </div>
            <div class="card">
                <h2>{{ $subject['name'] }}</h2>
                <hr>
                <div class="room-info">
                    <div class="room-info-name">
                        <p>Code</p>
                        <p>Credits</p>
                        <p>Guarantor</p>
                    </div>
                    <div class="room-info-value">
                        <p>{{ $subject['code'] }}</p>
                        <p>{{ $subject['credits'] }}</p>
                        <p>{{ $subject['guarantor_id'] }}</p>
                    </div>
                </div>
                {{--Další detaily uživatele --}}
            </div>
            <div class="card">
                <h3>Other information about the subject</h3>
                <hr>
                <p>Annotation</p>
                <p>{{ $subject['annotation'] }}</p>
                <p>More information HERE</p>
                {{--Další detaily uživatele --}}
            </div>
        </div>
    </div>
@endsection
