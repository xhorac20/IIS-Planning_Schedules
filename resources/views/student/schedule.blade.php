@extends('layouts.app')

@section('title', 'Moj Rozvrh')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavní obsah -->
        <div class="schedule-container">
            <h2>Môj Rozvrh</h2>
            <table class="table table-bordered schedule-table">
                <thead>
                <tr>
                    <th>Dny / Čas</th>
                    @for ($i = 7; $i <= 20; $i++)
                        <th>{{ $i }}:00</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @foreach (['Po', 'Út', 'St', 'Čt', 'Pá'] as $day)
                    <tr>
                        <td>{{ $day }}</td>
                        @for ($i = 7; $i <= 20; $i++)
                            <!-- Zde můžete přidat logiku pro zobrazení předmětů podle času a dne -->
                            <td class="schedule-slot"></td>
                        @endfor
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
