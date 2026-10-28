<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Game Store' }}</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <x-header />

    <main class="page-container">
        @yield('content')
    </main>

    <x-footer />

</body>
</html>
