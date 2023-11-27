@extends('layouts.app')

@section('title', 'Môj Rozvrh')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavný obsah -->
        <div class="schedule-container">
            <h2>Môj Rozvrh</h2>
            <table class="table table-bordered schedule-table">
                <thead>
                <tr>
                    <th>Hodina / Deň</th>
                    @for ($hour = 7; $hour <= 20; $hour++)
                        <th>{{ $hour }}:00</th>
                    @endfor
                </tr>
                </thead>
                <tbody>
                @foreach (['Po', 'Ut', 'St', 'Št', 'Pi'] as $day)
                    <tr>
                        <td>{{ $day }}</td>
                        @for ($hour = 7; $hour <= 20; $hour++)
                            <td class="schedule-slot">
                                @if (!empty($scheduleData[$day][$hour]))
                                    @foreach ($scheduleData[$day][$hour] as $activity)
                                        <div class="activity">
                                            <div>{{ $activity['subject'] }} ({{ $activity['type'] }})</div>
                                            <div>{{ $activity['room'] }}</div>
                                            <div>{{ $activity['repetition'] }}</div>
                                            @if ($activity['event_date'])
                                                <div>{{ $activity['event_date'] }}</div>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Sem môžete vložiť obsah pre prázdne sloty -->
                                @endif
                            </td>
                        @endfor
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
