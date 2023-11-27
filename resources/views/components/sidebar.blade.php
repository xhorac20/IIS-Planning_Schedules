<div class="sidebar">

    <!-- Odkazy pro neregistrované uživatele -->
    @guest

        <span>Guest</span>
        <div class="account">
            <div class="button-group-right">
                <button onclick="location.href='{{ route('login') }}'" class="btn-dark-blue">Log in</button>
                <button onclick="location.href='{{ route('register') }}'" class="btn-dark-blue">Register</button>
            </div>
        </div>
    @endguest


    @auth
        @if(Auth::user()->isAdmin())
            <span>Admin</span>
        @endif

        @if(Auth::user()->isGuarantor())
            <span>Garant</span>
        @endif

        @if(Auth::user()->isTeacher())
            <span>Vyučujúci</span>
        @endif

        @if(Auth::user()->isScheduler())
            <span>Rozvrhár</span>
        @endif

        @if(Auth::user()->isStudent())
            <span>Študent</span>
        @endif
        <span>{{ Auth::user()->name }}</span>
    @endauth


    @auth
        <div class="account">
            <div class="button-group-middle">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <!-- Použití tlačítka pro odeslání formuláře -->
                    <button type="submit" class="btn-dark-blue">Logout</button>
                </form>
            </div>
        </div>

        <ul class="list-unstyled">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ul>
    @endauth

    <ul class="list-unstyled">
        @auth
            <!-- Admin -->
            @if(Auth::user()->isAdmin())
                <li><a class="administration">Administration</a></li>
                <li><a href="{{ route('users.index') }}" class="administer">User Management</a></li>
                <li><a href="{{ route('rooms.index') }}" class="administer">Rooms Management</a></li>
                <li><a href="{{ route('subjects.index') }}" class="administer">Subjects Management</a></li>
                <!-- Další odkazy pro admina -->
            @endif
        @endauth

        <li><a href="{{ route('guest.browse-subjects') }}">Zoznam predmetov</a></li>

        @auth
            <!-- Garant předmětu -->
            @if(Auth::user()->isGuarantor() || Auth::user()->isAdmin())
                <li><a href="{{ route('guarantor.manage-activities') }}">Správa výukových aktivít</a></li>
                <!-- Další odkazy pro garanta -->
            @endif

            <!-- Rozvrhár -->
            @if(Auth::user()->isScheduler() || Auth::user()->isAdmin())
                <li><a href="{{ route('scheduler.manage-schedules') }}">Správa rozvrhů</a></li>
                <!-- Další odkazy pro rozvrháře -->
            @endif

            <!-- Vyučujúci -->
            @if(Auth::user()->isTeacher() || Auth::user()->isGuarantor() || Auth::user()->isScheduler() || Auth::user()->isAdmin())
                <li><a href="{{ route('teacher.schedule') }}">Môj rozvrh výuky</a></li>
                <!-- Další odkazy pro vyučujícího -->
            @endif

            @if(Auth::user()->isTeacher() || Auth::user()->isGuarantor() || Auth::user()->isScheduler() || Auth::user()->isAdmin())
                <li><a href="{{ route('teacher.schedule-requirements') }}">Požadavky na rozvrh</a></li>
                <!-- Další odkazy pro vyučujícího -->
            @endif

            <!-- Študent -->
            @if(Auth::user()->isStudent() || Auth::user()->isAdmin())
                <li><a href="{{ route('student.schedule') }}">Môj študijny rozvrh</a></li>
                <!-- Další odkazy pro studenta -->
            @endif
        @endauth
    </ul>
</div>
