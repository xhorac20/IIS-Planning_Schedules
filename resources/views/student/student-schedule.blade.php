@extends('layouts.app')

@section('title', 'Moj Rozvrh')

@section('content')
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavny obsah -->
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
                @foreach (['Po', 'Ut', 'St', 'Št', 'Pi'] as $day)
                    <tr>
                        <td>{{ $day }}</td>
                        @for ($i = 7; $i <= 20;)
                            @if (!empty($scheduleData[$day]) && !empty($scheduleData[$day][$i]))
                                @php
                                    $isScheduled = true;
                                    $maxDuration = max(array_column($scheduleData[$day][$i], 'duration'));
                                    $colspan = ceil($maxDuration / 60);
                                @endphp
                                <td class="schedule-slot" colspan="{{ $colspan }}">
                                    @foreach ($scheduleData[$day][$i] as $activity)
                                        <div>{{ $activity['subject'] }} ({{ $activity['type'] }}
                                            ) {{ $activity['room'] }}</div>
                                        <div>{{ $activity['repetition'] }}</div>
                                        <div>{{ $activity['event_date'] }}</div>
                                    @endforeach
                                </td>
                                @php $i += $colspan; @endphp
                            @else
                                <td class="schedule-slot"></td>
                                @php $i++; @endphp
                            @endif
                        @endfor
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
