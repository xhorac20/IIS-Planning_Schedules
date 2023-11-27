@extends('layouts.app')

@section('title', 'Upravit místnost')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container">
            <div class="event-title-manage event-title">
                <h1>Edit Room: {{ $room->name }}</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <form class="delete-button create-button" action="{{ route('rooms.destroy', $room->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="create-button" type="submit"
                            onclick="return confirm('Are you sure you want to delete this {{ $room->name }} ?')">Delete
                    </button>
                </form>
            </div>

            <form method="POST" action="{{ route('rooms.update', $room) }}">
                @csrf
                @method('PUT')

                <div class="borders">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $room->name }}" required>
                </div>
                <div class="borders">
                    <label for="location">Room Location</label>
                    <input type="text" name="location" id="location" value="{{ $room->location }}" required>
                </div>
                <div class="borders">
                    <label for="capacity">Room Capacity:</label>
                    <input type="number" name="capacity" id="capacity" value="{{ $room->capacity }}" required>
                </div>

                <div class="buttons">
                    <button type="submit">Save</button>
                    <button type="button" onclick="window.location.href = '{{ route('rooms.index') }}'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
