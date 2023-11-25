@extends('layouts.app')

@section('title', 'Prechádzanie Predmetov')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        {{-- TODO move styles too app.css --}}
        <div class="container">
            <table style="border: 1px solid black">
                <thead>
                <th style="border: 1px solid black">WIP</th>
                @foreach(['Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek'] as $day)
                    <th style="border: 1px solid black">{{ $day }}</th>
                @endforeach
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
@endsection
