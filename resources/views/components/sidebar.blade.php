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
        <div class="button-group-middle">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <!-- Použití tlačítka pro odeslání formuláře -->
                <button type="submit" class="btn-dark-blue">Logout</button>
            </form>
        </div>

    @endauth

    <ul class="list-unstyled">
        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li><a href="{{ route('guest.browse-subjects') }}">Zoznam predmetov</a></li>

        @auth
            <!-- Dynamický obsah pro přihlášené uživatele -->
            <!-- Další odkazy specifické pro přihlášené uživatele -->
            @if(Auth::user()->isAdmin())
                <li><a href="{{ route('admin.panel') }}">Admin Panel</a></li>
                <!-- Další admin specifické odkazy -->
            @endif
        @endauth
    </ul>
</div>
