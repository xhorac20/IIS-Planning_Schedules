@extends('layouts.app')

@section('title', 'Vytvořit nový předmět')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container">
            <div class="event-title">
                <h1>Create new Subject</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            <form method="POST" action="{{ route('subjects.store') }}">
                @csrf
                <label for="code"></label>
                <input type="text" name="code" id="code" placeholder="Code" required>

                <label for="name"></label>
                <input type="text" name="name" id="name" placeholder="Name" required>

                <label for="annotation"></label>
                <input type="text" name="annotation" id="annotation" placeholder="Annotation" required>

                <label for="credits"></label>
                <input type="number" name="credits" id="credits" placeholder="Credits" required>

                <label for="guarantor_id">
                    <select name="guarantor_id" id="guarantor_id" required>
                        <option>-- None --</option>
                        @foreach($users as $user)
                            @if($user->role === 'guarantor')
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </label>

                <button type="submit">Create Subject</button>
                <button type="button" onclick="location.href = '{{ route('subjects.index') }}'">Cancel</button>
            </form>
        </div>
    </div>
@endsection
