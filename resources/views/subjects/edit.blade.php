@extends('layouts.app')

@section('title', 'Upravit předmět')

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
                <h1>Edit Subject: {{ $subject['name'] }} ({{ $subject['code'] }})</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('subjects.update', $subject['id']) }}">
                @csrf
                @method('PUT')

                <div class="borders">
                    <label for="code">Code:</label>
                    <input type="text" name="code" id="code" value="{{ $subject['code'] }}" required>
                </div>
                <div class="borders">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" value="{{ $subject['name'] }}" required>
                </div>
                <div class="borders">
                    <label for="annotation">Annotation:</label>
                    <input type="text" name="annotation" id="annotation" value="{{ $subject['annotation'] }}" required>
                </div>
                <div class="borders">
                    <label for="credits">Credits:</label>
                    <input type="number" name="credits" id="credits" value="{{ $subject['credits'] }}" required>
                </div>
                <div class="borders borders-role">
                    <label for="guarantor_id"> Subject guarantor:
                        <select name="guarantor_id" id="guarantor_id" required>
                            @foreach($users as $user)
                                @if($user->role === 'guarantor')
                                    <option value="{{ $user->id }}
                                {{ $subject['guarantor_id'] == $user->id ? 'selected' : '' }}>">{{ $user['name'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="buttons">
                    <button type="submit">Save</button>
                    <button type="button" onclick="location.href = '{{ route('subjects.index') }}'">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
