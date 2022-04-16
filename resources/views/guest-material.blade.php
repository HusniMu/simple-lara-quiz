<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="antialiased">
    <div class="relative flex justify-center min-h-screen py-4 items-top sm:items-center sm:pt-0">
        @if (Route::has('login'))
        <div class="fixed top-0 right-0 hidden px-6 py-4 sm:block">
            @auth
            <a href="{{ url('/dashboard') }}" class="text-sm underline text-black-700 dark:text-black-500">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-sm underline text-black-700 dark:text-black-500">Log in</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="ml-4 text-sm underline text-black-700 dark:text-black-500">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <hr>
        <div class="w-6/12 p-5 mt-5 border rounded shadow">
            <h1 class="text-2xl font-bold">
                {{ $material->title }}
            </h1>
            {{--
            <pre style="white-space: pre-wrap;" class="font-semibold"> --}}
            <p  class="font-semibold">
                {!! nl2br($material->body) !!}
            </p>
            <a href="{{ route('welcome') }}">
                <p class="text-xs">back</p>
            </a>
        </div>
    </div>
</body>

</html>
