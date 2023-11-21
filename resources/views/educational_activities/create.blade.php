@extends('layouts.app')

@section('title', 'Vytvořit novou výukovou aktivitu')

@section('content')
    <h1>Vytvořit novou výukovou aktivitu</h1>

    <form method="POST" action="{{ route('educational-activities.store') }}">
        @csrf
        <label for="subject_id">Předmět:</label>
        <select name="subject_id" id="subject_id" required>
            {{-- Zde byste měli načíst seznam předmětů --}}
        </select>

        <label for="type">Typ aktivity:</label>
        <input type="text" name="type" id="type" required>

        <label for="duration">Délka trvání:</label>
        <input type="number" name="duration" id="duration" required>

        <label for="repetition">Opakování:</label>
        <input type="text" name="repetition" id="repetition" required>

        <button type="submit">Vytvořit aktivitu</button>
    </form>
@endsection
