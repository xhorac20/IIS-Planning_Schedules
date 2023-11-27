@extends('layouts.app')

@section('title', 'Detail místnosti')

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
                <h1>Room Detail</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('rooms.edit', $room) }}" class="create-button btn-dark-blue">Edit</a>
                <form class="delete-button create-button" action="{{ route('rooms.destroy', $room->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="create-button" type="submit"
                            onclick="return confirm('Are you sure you want to delete this {{ $room->name }} ?')">Delete
                    </button>
                </form>
            </div>
            <div class="detail-content">
                <div class="card">
                    <h2>{{ $room->name }}</h2>
                    <hr>
                    <div class="room-info">
                        <div class="room-info-name">
                            <p>Location</p>
                            <p>Capacity</p>
                        </div>
                        <div class="room-info-value">
                            <p>{{ $room->location }}</p>
                            <p>{{ $room->capacity }}</p>
                        </div>
                    </div>
                    {{--Další detaily uživatele --}}
                </div>
                <div class="card">
                    <h3>Other information about this room</h3>
                    <hr>
                    <p>More information HERE</p>
                    {{--Další detaily uživatele --}}
                </div>
            </div>
        </div>
    </div>
@endsection
