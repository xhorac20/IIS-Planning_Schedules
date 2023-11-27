@extends('layouts.app')

@section('title', 'Seznam uživatelů')

@section('content')
    <script>
        $('#search').on('input', function () {

            var search = $(this).val();

            $.get('/users', {search: search}, function (data) {
                // zobrazi userov
            });
            if (data.length === 0) {
                $("#users").html("Nothing found");
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
                <h1>User Management</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
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
                                <input type="text" id="search" name="search" placeholder="Search User"
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
                                <li style="display: flex; flex-direction: row"><a
                                        href="{{ route('users.edit', $user->id) }}">Edit</a>
                                    <form class="delete-all" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this {{ $user->name }} ?')">
                                            Delete
                                        </button>
                                    </form>
                                </li>
                                {{--                                <li><a href="{{ route('users.edit', $user->id) }}">Edit</a></li>--}}
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
