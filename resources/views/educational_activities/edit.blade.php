@extends('layouts.app')

@section('title', 'Upravit výukovou aktivitu')

@section('content')
    <h1>Upravit výukovou aktivitu: {{ $educationalActivity->type }}</h1>

    <form method="POST" action="{{ route('educational-activities.update', $educationalActivity) }}">
        @csrf
        @method('PUT')

        <label for="subject_id">Předmět:</label>
        <select name="subject_id" id="subject_id" required>
            {{-- Seznam předmětů s výběrem aktuální hodnoty --}}
        </select>

        <label for="type">Typ aktivity:</label>
        <input type="text" name="type" id="type" value="{{ $educationalActivity->type }}" required>

        <label for="duration">Délka trvání:</label>
        <input type="number" name="duration" id="duration" value="{{ $educationalActivity->duration }}" required>

        <label for="repetition">Opakování:</label>
        <input type="text" name="repetition" id="repetition" value="{{ $educationalActivity->repetition }}" required>

        <button type="submit">Aktualizovat aktivitu</button>
    </form>
@endsection
