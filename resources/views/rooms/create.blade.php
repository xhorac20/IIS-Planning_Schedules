@extends('layouts.app')

@section('title', 'Vytvořit novou místnost')
@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container">
            <div class="event-title">
                <h1>Add new room</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <form method="POST" action="{{ route('rooms.store') }}">
                @csrf
                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Room Name" required>

                <label for="location"></label>
                <input type="text" name="location" id="location" placeholder="Location" required>

                <label for="capacity"></label>
                <input type="number" name="capacity" id="capacity" placeholder="Room capacity" required>

                <button type="submit">Add Room</button>
                <button type="button" onclick="window.location.href = '{{ route('rooms.index') }}'">Cancel</button>
            </form>
        </div>
    </div>
@endsection

