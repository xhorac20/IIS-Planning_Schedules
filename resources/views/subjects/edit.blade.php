@extends('layouts.app')

@section('title', 'Upravit předmět')

@section('content')
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
                <form class="delete-button create-button" action="{{ route('subjects.destroy', $subject->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="create-button" type="submit"
                            onclick="return confirm('Are you sure you want to delete this {{ $subject->name }} ?')">Delete
                    </button>
                </form>
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
                    <label for="guarantor_id">Subject guarantor:
                        <select name="guarantor_id" id="guarantor_id" required>
                            @foreach($users as $user)
                                @if($user->role === 'guarantor')
                                    <option value="{{ $user->id }}" {{ $subject['guarantor_id'] == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
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
