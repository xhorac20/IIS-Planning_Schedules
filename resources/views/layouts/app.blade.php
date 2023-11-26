<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
{{--    URL na jquery-3.6.4 alebo Lokalne stiahnut --}}
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>@yield('title', 'Default Title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header>
    <!-- Hlavička aplikace -->
</header>

<main>
    @yield('content')
</main>

<footer>
    <!-- Pata aplikace -->
    <div class="footer-content">
        <p>Vytvorené tímom xhorac20: Andrej Horáček (xhorac20), Jakub Brčiak (xbrcia00), Matěj Novák (xnovak2v)</p>
        <p>Názov projektu: Plánování rozvrhů</p>
    </div>
</footer>

</body>
</html>
