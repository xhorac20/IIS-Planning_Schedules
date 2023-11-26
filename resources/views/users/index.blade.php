@extends('layouts.app')

@section('title', 'Seznam uživatelů')

@section('content')
    <script>
        $('#search').on('input', function() {

            var search = $(this).val();

            $.get('/users', {search: search}, function(data) {
                // zobrazi userov
            });
            if(data.length === 0) {
                $("#users").html("Nothing found");
            } else {
                // zobrazi najdenych userov
            }
        });
    </script>
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container">
            <div class="event-title-manage event-title">
                <h1>User Management</h1>
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('users.create') }}" class="create-button btn-dark-blue">Create User</a>
            </div>
            <div class="manage-content">
                <ul>
                    <li class="head">
                        <ul class="head-menu">
                            <li>Name</li>
                            <li>Email</li>
                            <li>Role</li>
                            <form>
                                <label for="search"></label>
                                <input type="text" id="search" name="search" placeholder="Search for User"
                                       value="{{ session()->get('search') ?? request()->get('search') }}">
                            </form>
                        </ul>
                    </li>
                    <hr class="splitter">
                    @foreach ($users as $user)
                        <li class="items" onclick="location.href = '{{ route('users.show', $user->id) }}'">
                            <ul class="head-menu">
                                <li>{{ $user->name }}</li>
                                <li>{{ $user->email }}</li>
                                <li>{{ ucfirst($user->role) }}</li>
                                <li><a href="{{ route('users.edit', $user->id) }}">Edit</a></li>
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
