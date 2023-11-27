@extends('layouts.app')

@section('title', 'Seznam místností')

@section('content')
    <script>
        $('#search').on('input', function() {

            var search = $(this).val();

            $.get('/rooms', {search: search}, function(data) {
                // zobrazi userov
            });
            if(data.length === 0) {
                $("#rooms").html("Nothing found");
            } else {
                // zobrazi najdenych userov
            }
        });

        // Animacia Alertu zmizne po 10 sekundach
        $(document).ready(function () {
            // Ked sa nacita stranka prida sa element
            $('#Alert').fadeIn();

            // Po 10 sekundach sa zavola funkcia na skrytie alertu
            setTimeout(function () {
                hideAlert();
            }, 10000); // 15 sekund
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
            <div class="event-title-manage event-title">
                <h1>Rooms Management</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('rooms.create') }}" class="create-room-button create-button btn-dark-blue">Add New Room</a>
            </div>
            <div class="manage-content">
                <ul>
                    <li class="head">
                        <ul class="head-menu">
                            <li>Name</li>
                            <li>Location</li>
                            <li>Capacity</li>
                            <form>
                                <label for="search"></label>
                                <input type="text" id="search" name="search" placeholder="Search for Room"
                                       value="{{ session()->get('search') ?? request()->get('search') }}">
                            </form>
                        </ul>
                    </li>
                    <hr class="splitter">
                    @foreach ($rooms as $room)
                        <li class="items" onclick="location.href = '{{ route('rooms.show', $room->id) }}'">
                            <ul class="head-menu">
                                <li>{{ $room->name }}</li>
                                <li>{{ $room->location }}</li>
                                <li>{{ ucfirst($room->capacity) }}</li>
                                <li><a href="{{ route('rooms.edit', $room->id) }}">Edit</a></li>
                            </ul>
                        </li>
                        <hr class="splitter">
                    @endforeach
                    <hr class="end-table">
                </ul>

            </div>
        </div>
    </div>
@endsection
