<div class="sidebar">
    <!-- Odkazy pro neregistrované uživatele -->
    @guest
        <span>Guest</span>

        <div class="button-group-right">
            <button onclick="location.href='{{ route('login') }}'" class="btn-dark-blue">Log in</button>
            <button onclick="location.href='{{ route('register') }}'" class="btn-dark-blue">Register</button>
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
        <div class="button-group-middle">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <!-- Použití tlačítka pro odeslání formuláře -->
                <button type="submit" class="btn-dark-blue">Logout</button>
            </form>
        </div>

        <ul class="list-unstyled">
            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        </ul>
    @endauth

    <ul class="list-unstyled">
        <li><a href="{{ route('guest.browse-subjects') }}">Zoznam predmetov</a></li>

        @auth
            <!-- Admin -->
            @if(Auth::user()->isAdmin())
                <li><a href="{{ route('admin.panel') }}">Admin Panel</a></li>
                <li><a href="{{ route('manage.users') }}">Správa užívateľov</a></li>
                <li><a href="{{ route('manage.rooms') }}">Správa miestností</a></li>
                <li><a href="{{ route('manage.subjects') }}">Správa predmetov</a></li>
                <!-- Další odkazy pro admina -->
            @endif

            <!-- Garant předmětu -->
            @if(Auth::user()->isGuarantor())
                <li><a href="{{ route('manage.activities') }}">Správa výukových aktivít</a></li>
                <!-- Další odkazy pro garanta -->
            @endif

            <!-- Vyučujúci -->
            @if(Auth::user()->isTeacher())
                <li><a href="{{ route('teacher.schedule') }}">Môj rozvrh</a></li>
                <!-- Další odkazy pro vyučujícího -->
            @endif

            <!-- Rozvrhár -->
            @if(Auth::user()->isScheduler())
                <li><a href="{{ route('scheduler.panel') }}">Rozvrhárský panel</a></li>
                <!-- Další odkazy pro rozvrháře -->
            @endif

            <!-- Študent -->
            @if(Auth::user()->isStudent())
                <li><a href="{{ route('student.schedule') }}">Môj osobný rozvrh</a></li>
                <!-- Další odkazy pro studenta -->
            @endif
        @endauth
    </ul>
</div>
