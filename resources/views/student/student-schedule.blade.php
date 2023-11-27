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
                    @foreach (['Po', 'Ut', 'St', 'Št', 'Pi'] as $day)
                        <th>{{ $day }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @for ($hour = 7; $hour <= 20; $hour++)
                    <tr>
                        <td>{{ $hour }}:00</td>
                        @foreach (['Po', 'Ut', 'St', 'Št', 'Pi'] as $day)
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
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
