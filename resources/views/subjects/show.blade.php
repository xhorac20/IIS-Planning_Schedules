@extends('layouts.app')

@section('title', 'Detail Předmětu')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="flex-grow-1">
            <h1>{{ $subject->name }}</h1>
            <p>Kód: {{ $subject->code }}</p>
            <p>Anotace: {{ $subject->annotation }}</p>
            <p>Počet kreditů: {{ $subject->credits }}</p>
            {{-- Zde můžete přidat další detaily o předmětu --}}
        </div>
    </div>
    <!-- <a href="{{ route('subjects.edit', $subject) }}">Upravit</a> -->
@endsection
