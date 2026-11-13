<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Game Store' }}</title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v=20261113-2">
</head>

<body>

    <x-header />

    <main class="page-container">
        @if (session('success'))
            <div class="flash-message">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="flash-message flash-error">{{ $errors->first() }}</div>
        @endif

        @yield('content')
    </main>

    <x-footer />

</body>
</html>