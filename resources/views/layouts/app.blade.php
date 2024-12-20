<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Belanja.com</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.2.3/css/flag-icons.min.css">
    @stack('customcss')
</head>

<body class="light">
    @stack('nav')
    @yield('content')
    @stack('footer')
    @stack('tab')
    <script type="module" src="{{ asset('assets/js/beer.js') }}"></script>
    @stack('customjs')
</body>

</html>
