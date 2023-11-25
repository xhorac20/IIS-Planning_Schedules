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
                            @php
                                $isScheduled = false;
                                $colspan = 1;
                                $subjectDetail = '';
                            @endphp
                            @if (!empty($scheduleData[$day]) && !empty($scheduleData[$day][$i]))
                                @php
                                    $isScheduled = true;
                                    $subjectDetail = $scheduleData[$day][$i]['subject'] . ' (' . $scheduleData[$day][$i]['type'] . ') ' . $scheduleData[$day][$i]['room'];
                                    $duration = $scheduleData[$day][$i]['duration'];
                                    $colspan = ceil($duration / 60);
                                    $i += $colspan; // Skip slots covered by colspan
                                @endphp
                                <td class="schedule-slot" colspan="{{ $colspan }}">
                                    {{ $subjectDetail }}
                                    Trvanie: {{ $duration }} min
                                </td>
                            @endif
                            @if (!$isScheduled)
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
