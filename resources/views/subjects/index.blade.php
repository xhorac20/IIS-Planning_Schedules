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
                <a href="{{ route('subjects.create') }}" class="create-button create-sub-button btn-dark-blue">Add
                    Subject</a>
            </div>
            <div class="manage-content">
                <ul>
                    <li class="head">
                        <ul class="head-menu head-menu-sub">
                            <li>Code</li>
                            <li>Name</li>
                            <li>Credits</li>
                            <li>Guarantor</li>
                            <li>
                                <form>
                                    <label for="search"></label>
                                    <input type="text" id="search" name="search" placeholder="Search Subject"
                                           value="{{ session()->get('search') ?? request()->get('search') }}">
                                </form>
                            </li>
                        </ul>
                    </li>
                    <hr class="splitter">
                    @foreach ($subjects as $subject)
                        <li class="items" onclick="location.href = '{{ route('subjects.show', $subject->id) }}'">
                            <ul class="head-menu head-menu-sub move-edit">
                                <li>{{ $subject['code'] }}</li>
                                <li>{{ $subject['name'] }}</li>
                                <li>{{ $subject['credits'] }}</li>
                                {{-- Skontrolujte, či existuje garant, a vypíšte jeho meno --}}
                                <li>
                                    @if ($user = $users->find($subject['guarantor_id']))
                                        {{ $user->name }}
                                    @else
                                        Nenastavený
                                    @endif
                                </li>
                                <li style="display: flex; flex-direction: row">
                                    <a href="{{ route('subjects.edit', $subject->id) }}">Edit</a>
                                    <form class="delete-all" action="{{ route('subjects.destroy', $subject->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Are you sure you want to delete this {{ $subject->name }} ?')">
                                            Delete
                                        </button>
                                    </form>
                                </li>
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
