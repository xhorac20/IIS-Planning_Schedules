<x-guest-layout>
    <div class="login-container">
        <!-- Nadpis -->
        <h1 class="form-label">Prihlásenie</h1>

        <!-- Formulář Přihlášení -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Emailová Adresa -->
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Heslo -->
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Tlačítka -->
            <div class="button-group-middle">
                <x-primary-button class="btn-dark-blue">
                    {{ __('Log in') }}
                </x-primary-button>

                <a href="{{ route('register') }}" class="btn-dark-blue">
                    {{ __('Register') }}
                </a>

                <a href="{{ route('guest.browse-subjects') }}" class="btn-dark-blue">
                    {{ __('Guest') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
