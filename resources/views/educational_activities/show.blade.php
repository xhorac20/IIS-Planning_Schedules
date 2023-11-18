@extends('layouts.app')

@section('title', 'Detail výukové aktivity')

@section('content')
    <h1>{{ $educationalActivity->type }}</h1>
    <p>Předmět: {{ $educationalActivity->subject->name }}</p>
    <p>Délka trvání: {{ $educationalActivity->duration }}</p>
    <p>Opakování: {{ $educationalActivity->repetition }}</p>

    <a href="{{ route('educational-activities.edit', $educationalActivity) }}">Upravit</a>
@endsection
