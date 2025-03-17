<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Usein kysytyt kysymykset</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-gray-200">

    <!-- Navigaatio -->
    @if (Route::has('login'))
        <nav class="-mx-3 flex flex-1 justify-end">
            <a href="http://127.0.0.1:8000/" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Etusivu
            </a>
            
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif

    <!-- UKK-sisältö -->
    <div class="container mx-auto max-w-4xl p-6">
    <h1 class="text-3xl font-semibold mb-6">Usein kysytyt kysymykset</h1>

    <div class="space-y-4">
        <div>
            <p class="font-semibold text-xl">Kysymys 1:</p>
            <p id="ukk1" class="hidden mt-2">Vastaus</p>
        </div>

        <div>
            <p class="font-semibold text-xl">Kysymys 2:</p>
            <p id="ukk2" class="hidden mt-2">Vastaus</p>
        </div>
    </div>
</div>


</body>
</html>
