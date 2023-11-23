@extends('layouts.app')

@section('title', 'Prechádzanie Predmetov')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar />

        <!-- Hlavní obsah - Zoznam predmetov -->
        <div class="flex-grow-1">
            <h2 class="text-center">Zoznam Predmetov</h2>
            <ul>
                @foreach ($subjects as $subject)
                    <li>
                        <a href="{{ route('subjects.show', $subject) }}">{{ $subject->name }}</a>
                        - {{ $subject->description }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
