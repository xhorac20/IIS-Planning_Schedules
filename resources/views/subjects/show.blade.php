@extends('layouts.app')

@section('title', 'Detail předmětu')

@section('content')
    <h1>{{ $subject->name }}</h1>
    <p>Kód: {{ $subject->code }}</p>
    <p>Anotace: {{ $subject->annotation }}</p>
    <p>Počet kreditů: {{ $subject->credits }}</p>

    <a href="{{ route('subjects.edit', $subject) }}">Upravit</a>
@endsection
