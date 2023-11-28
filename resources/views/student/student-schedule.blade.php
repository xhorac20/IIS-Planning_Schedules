@extends('layouts.app')

@section('title', 'Môj Rozvrh')

@section('content')

    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <!-- Hlavný obsah -->
        <div class="schedule-container">
            <div class="event-title">
                <h1 class="text-center">Môj Rozvrh</h1>
            </div>
            <div class="scroll">
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
                                            @php
                                                $startMinutes = \Carbon\Carbon::createFromFormat('H:i', $activity['start'])->format('i');
                                            @endphp
                                            <div @class(['activity', 'minute-15' => $startMinutes == '15',
                                                     'minute-30' => $startMinutes == '30', 'minute-45' => $startMinutes == '45',
                                                     'cvicenie' => $activity['type'] == 'Cvičenie',
                                                     'skuska' => $activity['type'] == 'Skúška',
                                                    //'special' => !in_array($activity['type'], ['Cvičenie', 'Prednáška'])
                                                     'ine' => $activity['type'] == 'Iné',])>
                                                <div>{{ $activity['subject'] }} ({{ $activity['type'] }})</div>
                                                <div>{{ $activity['room'] }} {{ $activity['duration'] }}</div>

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

    </div>
@endsection
