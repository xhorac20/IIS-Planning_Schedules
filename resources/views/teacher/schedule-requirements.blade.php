@extends('layouts.app')

@section('title', 'Prechádzanie Predmetov')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="container">
            <h2>Požadavky na rozvrh</h2>
            <p>Vyhovující dny a časy:</p>
            <form method="POST" action="{{-- route() --}}">
                @foreach(['Pondělí', 'Úterý', 'Středa', 'Čtvrtek', 'Pátek'] as $day)
                    <div>
                        <div>
                            <input type="checkbox" id="{{ $day }}" name="{{ $day }}" onchange="document.getElementById('input_{{ $day }}').style.display = this.checked ? 'inline' : 'none'">
                            <label for="{{ $day }}">{{ $day }}</label>
                        </div>
                        <div id="input_{{ $day }}" style="display: none">
                            <label for="start_{{ $day }}">Od:</label>
                            <input type="time" id="start_{{ $day }}" name="start_{{ $day }}" value="08:00">
                            <label for="end_{{ $day }}">do:</label>
                            <input type="time" id="end_{{ $day }}" name="end_{{ $day }}" value="20:00">
                        </div>
                    </div><br>
                @endforeach
                <button type="submit">Uložit požadavky</button><br><br>
            </form>
        </div>
    </div>
@endsection
