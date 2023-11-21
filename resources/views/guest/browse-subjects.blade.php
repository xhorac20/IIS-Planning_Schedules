@extends('layouts.app')

@section('title', 'Prechádzanie Predmetov')

@section('content')
    <div class="container">
        <h2>Zoznam Predmetov</h2>
        <ul>
            @foreach ($subjects as $subject)
                <li>{{ $subject->name }} - {{ $subject->description }}</li>
            @endforeach
        </ul>
    </div>
@endsection
