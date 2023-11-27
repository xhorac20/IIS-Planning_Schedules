@extends('layouts.app')

@section('title', 'Seznam předmětů')

@section('content')
    <script>
        $('#search').on('input', function () {

            var search = $(this).val();

            $.get('/subjects', {search: search}, function (data) {
                // zobrazi predmety
            });
            if (data.length === 0) {
                $("#subjects").html("Nothing found");
            } else {
                // zobrazi najdenych predmety
            }
        });

        // Animacia Alertu zmizne po 10 sekundach
        $(document).ready(function () {
            // Ked sa nacita stranka prida sa element
            $('#Alert').fadeIn();

            // Po 10 sekundach sa zavola funkcia na skrytie alertu
            setTimeout(function () {
                hideAlert();
            }, 10000); // 15 sekund
        });

        function hideAlert() {
            // Trieda s animaciou vystupu
            $('#Alert').fadeOut();

            // skončení animácie sa element odstrani
            setTimeout(function () {
                $('#Alert').remove();
            }, 1000);
        }
    </script>
    <div class="d-flex">
        <!-- Sidebar -->
        <x-sidebar/>

        <div class="user-container">
            <div class="event-title-manage event-title">
                <h1>Subjects Management</h1>
                @if(session('success') || session('status'))
                    <div class="alert" id="Alert">
                        {{ session('success') }}
                        {{ session('status') }}
                    </div>
                @endif
                <a href="{{ route('subjects.create') }}" class="create-button btn-dark-blue">Add Subject</a>
            </div>
            <div class="manage-content">
                <ul>
                    <li class="head">
                        <ul class="head-menu">
                            <li>Code</li>
                            <li>Name</li>
                            <li>Annotation</li>
                            <li>Credits</li>
                            <li>Guarantor</li>
                            <form>
                                <label for="search"></label>
                                <input type="text" id="search" name="search" placeholder="Search Subjects"
                                       value="{{ session()->get('search') ?? request()->get('search') }}">
                            </form>
                        </ul>
                    </li>
                    <hr class="splitter">
                    @foreach ($subjects as $subject)
                        <li class="items" onclick="location.href = '{{ route('subjects.show', $subject->id) }}'">
                            <ul class="head-menu">
                                <li>{{ $subject['code'] }}</li>
                                <li>{{ $subject['name'] }}</li>
                                <li>{{ $subject['annotation'] }}</li>
                                <li>{{ $subject['credits'] }}</li>
                                <li>{{ $subject['guarantor_id'] }}</li>
                                <li><a href="{{ route('subjects.edit', $subject->id) }}">Edit</a></li>
                            </ul>
                        </li>
                        <hr class="splitter">
                    @endforeach
                    <hr class="end-table">
                </ul>
            </div>
        </div>
    </div>
@endsection
