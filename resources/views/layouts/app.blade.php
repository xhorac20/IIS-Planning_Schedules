<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
    <!-- Zde můžete přidat odkazy na CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<header>
    <!-- Hlavička aplikace -->
    <!-- Implementace navigační lišty (předpokládá se použití Bootstrapu) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Školní Rozvrh</a>
            <!-- Další prvky navigace -->
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <!-- Pata aplikace -->
</footer>

<!-- Zde můžete přidat odkazy na JavaScript -->
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
