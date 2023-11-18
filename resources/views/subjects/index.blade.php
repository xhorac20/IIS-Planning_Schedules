@extends('layouts.app')

@section('title', 'Seznam předmětů')

@section('content')
    <h1>Seznam předmětů</h1>

    <a href="{{ route('subjects.create') }}">Vytvořit nový předmět</a>

    <ul>
        @foreach ($subjects as $subject)
            <li>
                {{ $subject->name }}
                <a href="{{ route('subjects.show', $subject) }}">Zobrazit</a>
                <a href="{{ route('subjects.edit', $subject) }}">Upravit</a>
            </li>
        @endforeach
    </ul>
@endsection
