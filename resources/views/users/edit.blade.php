@extends('layouts.app')

@section('title', 'Upravit uživatele')

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
            <div class="event-title-manage event-title">
                <h1>Edit User: {{ $user->name }}</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <form class="delete-button create-button" action="{{ route('users.destroy', $user->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="create-button" type="submit"
                            onclick="return confirm('Are you sure you want to delete this {{ $user->name }} ?')">Delete
                    </button>
                </form>
            </div>

            <form method="POST" action="{{ route('users.update', $user) }}">
                @csrf
                @method('PUT')

                <div class="borders">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" required>
                </div>
                <div class="borders">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" value="{{ $user->email }}" required>
                </div>
                <div class="borders borders-role">
                    <label for="name">
                        Role:
                        <select name="role" id="role">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="guarantor" {{ $user->role == 'guarantor' ? 'selected' : '' }}>Guarantor
                            </option>
                            <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="scheduler" {{ $user->role == 'scheduler' ? 'selected' : '' }}>Scheduler
                            </option>
                            <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                        </select>
                    </label>
                </div>
                <div class="borders change-password">
                    <label for="password">Change Password</label>
                    <hr>
                    <input type="password" name="password" id="password" placeholder="Set New Password">
                </div>

                <div class="buttons">
                    <button type="submit">Save</button>
                    <button type="button" onclick="location.href = '{{ route('users.index') }}'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection

