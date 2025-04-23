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
    <h1 class="text-3xl font-semibold mb-6">Usein kysytyt kysymykset:</h1>

    <!-- Kategorian valinta -->
    <form method="GET" action="{{ route('ukk') }}" class="mb-4">
        <label for="category_name" class="block text-white mb-2">Valitse kategoria:</label>
        <select name="category_name" id="category_name" class="w-full p-2 rounded-lg">
            <option value="">Kaikki</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}" {{ request('category_name') == $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-700">
            Suodata
        </button>
    </form>



    <!-- Ehdotetut tiketit -->
    @if ($suggestions->count())
        @foreach ($suggestions as $suggestion)
            <div class="bg-white dark:bg-gray-800 p-4 mb-4 rounded shadow">
                <h3 class="text-lg font-semibold">Aihe: {{ $suggestion->feedback->aihe }}</h3>
                <p>Palaute: {{ $suggestion->feedback->palaute }}</p>
                
            </div>
        @endforeach
    @else
        <p>Ei ehdotettuja tikettejä.</p>
    @endif
</div>

</div>


</body>
</html>
