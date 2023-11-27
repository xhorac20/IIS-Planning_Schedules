@extends('layouts.app')

@section('title', 'Pridať výukovú aktivitu')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="flex-grow-1">
            <h1 class="text-center">Pridať výukovú aktivitu</h1>

            <form method="POST" action="{{ route('educational-activities.store') }}">
                @csrf

                <div class="form-group">
                    <label for="subject_id">Předmět:</label>
                    <select name="subject_id" id="subject_id" required>
                        {{-- Výběr předmětu, pro který uživatel je garant --}}
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->code }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Typ aktivity:</label>
                    <select name="type" id="type" required>
                        <option value="Prednáška">Prednáška</option>
                        <option value="Cvičenie">Cvičenie</option>
                        <option value="Skúška">Skúška</option>
                        <option value="Iné">Iné</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="duration">Dĺžka trvania (minúty):</label>
                    <input type="number" name="duration" id="duration" required>
                </div>

                <div class="form-group">
                    <label for="repetition">Opakování:</label>
                    <select name="repetition" id="repetition" required>
                        <option value="Každý">Každý</option>
                        <option value="Párny">Párny</option>
                        <option value="Nepárny">Nepárny</option>
                        <option value="Jednorázovo">Jednorázovo</option>
                    </select>
                </div>

                <button class="btn-send" type="submit">Pridať aktivitu</button>
            </form>
        </div>
    </div>
@endsection
