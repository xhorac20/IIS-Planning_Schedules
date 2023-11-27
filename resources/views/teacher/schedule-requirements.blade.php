@extends('layouts.app')

@section('title', 'Požadavky na rozvrh')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        {{-- TODO CSS --}}
        @php
            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday'];
            $localized = [
                'monday' => 'Pondělí',
                'tuesday' => 'Úterý',
                'wednesday' => 'Středa',
                'thursday' => 'Čtvrtek',
                'friday' => 'Pátek'
            ];
        @endphp
        <div class="flex-grow-1">
            <h2 class="text-center">Požadavky na rozvrh</h2>
            @if(session('success'))
                <h4 class="text-center">{{ session('success') }}</h4>
            @endif
            <p>Vyhovující dny a časy:</p>
            <form action="{{ route('schedule-requirements.edit') }}" method="POST">
                @csrf
                @foreach($days as $day)
                    @php
                        $requirement = $scheduleRequirements[$day] ?? null;
                    @endphp
                    <div>
                        <div>
                            <input type="checkbox" id="{{ $day }}" name="{{ $day }}" {{ $requirement ? 'checked' : '' }} onchange="document.getElementById('input_{{ $day }}').style.display = this.checked ? 'inline' : 'none'">
                            <label for="{{ $day }}">{{ $localized[$day] }}</label>
                        </div>
                        <div id="input_{{ $day }}" style="{{ $requirement ? 'display: inline' : 'display: none' }}">
                            <label for="start_{{ $day }}">Od:</label>
                            <input type="time" id="start_{{ $day }}" name="start_{{ $day }}" value="{{ $requirement ? date('H:i', strtotime($requirement->start_time)) : '08:00' }}">
                            <label for="end_{{ $day }}">do:</label>
                            <input type="time" id="end_{{ $day }}" name="end_{{ $day }}" value="{{ $requirement ? date('H:i', strtotime($requirement->end_time)) : '21:00' }}">
                        </div>
                    </div><br>
                @endforeach
                <button type="submit" class="btn-send">Uložit požadavky</button><br><br>

            </form>
        </div>
    </div>
@endsection
