@extends('layouts.app')

@section('title', 'Detail Předmětu')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container profile-container">
            <div class="event-title-manage event-title">
                <h1>Subject Detail</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('subjects.edit', $subject) }}" class="create-button btn-dark-blue">Edit</a>
                <form class="delete-button create-button" action="{{ route('subjects.destroy', $subject->id) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="create-button" type="submit"
                            onclick="return confirm('Are you sure you want to delete this {{ $subject->name }} ?')">Delete
                    </button>
                </form>
            </div>
            <div class="card">
                <h2>{{ $subject['name'] }}</h2>
                <hr>
                <div class="subject-info">
                    <div class="subject-info-name">
                        <p>Code:</p>
                        <p>Credits:</p>
                        <p>Guarantor:</p>
                    </div>
                    <div class="subject-info-value">
                        <p>{{ $subject['code'] }}</p>
                        <p>{{ $subject['credits'] }}</p>
                        <p>{{ $subject['guarantor_id'] }}</p>
                    </div>
                </div>
                {{--Další detaily uživatele --}}
            </div>
            <div class="card">
                <h3>Other information about the subject</h3>
                <hr>
                <p class="show-annot">Annotation</p>
                <p class="show-annot-value">{{ $subject['annotation'] }}</p>
            </div>
        </div>
    </div>
@endsection
