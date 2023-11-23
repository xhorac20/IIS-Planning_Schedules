@extends('layouts.app')

@section('title', 'Seznam uživatelů')

@section('content')
    <div class="body">
        <div class="menu">
            <ul>
                <li><a href="#">Domov</a></li>
                <li><a href="#">O nás</a></li>
                <li><a href="#">Služby</a></li>
                <li><a href="#">Kontakt</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>

        <div class="user-create-container">
            <div class="event-title-manage event-title">
                <h1>User Management</h1>
                <a href="{{ route('users.create') }}" class="create-button btn-dark-blue">Create User</a>
            </div>
            <div class="manage-content">
                <ul>
                    <li class="head">
                        <ul class="head-menu">
                            <li>Name</li>
                            <li>Email</li>
                            <li>Role</li>
                            <li><a></a></li>
                        </ul>
                    </li>
                    <hr>
                    @foreach ($users as $user)
                        <li class="items" onclick="location.href = '{{ route('users.show', $user->id) }}'">
                            <ul class="head-menu">
                                <li>{{ $user->name }}</li>
                                <li>{{ $user->email }}</li>
                                <li>{{ $user->role }}</li>
                                <li><a href="{{ route('users.edit', $user->id) }}">Edit</a></li>
                            </ul>
                        </li>
                        <hr>
                    @endforeach
                </ul>
                <hr class="end-table">
            </div>
        </div>
    </div>
@endsection
