@extends('layouts.app')

@section('title', 'Prihlásenie')

@section('content')
    <div class="login-container">
        <!-- Nadpis -->
        <h1 class="login-heading">Školský Rozvrh</h1>
        <!-- Formular Prihlasenia -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="login">Login:</label>
                <input id="login" type="text" class="form-control" name="login" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Heslo:</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-dark-blue">
                    {{ __('Login') }}
                </button>
                <a href="{{ route('register') }}" class="btn btn-dark-blue">
                    {{ __('Register') }}
                </a>
                <a href="{{ route('guest.browse-subjects') }}" class="btn btn-dark-blue">
                    {{ __('Hosť') }}
                </a>
            </div>
        </form>
    </div>
@endsection
