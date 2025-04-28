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
        <nav class=" flex flex-1 justify-end">
            <a href="http://127.0.0.1:8000/" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Etusivu
            </a>
            
            @auth
                <a
                    href="{{ url('/employee/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Työntekijä
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Kirjaudu
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Rekisteröidy
                    </a>
                @endif
            @endauth
        </nav>
    @endif

    <!-- UKK-sisältö -->
    <div class="container mx-auto max-w-4xl p-6">
    <h1 class="text-3xl font-semibold mb-6">Usein kysytyt kysymykset:</h1>

    <!-- Kategorian valinta -->
    <form method="GET" action="{{ route('ukk') }}" class="mb-6">
        <label for="category_name" class="block mb-2 text-white">Valitse kategoria:</label>
        <select name="category_name" id="category_name" class="w-full p-2 rounded-lg">
            <option value="">Valitse kategoria</option>
            <option value="Kaikki" {{ request('category_name') == 'Kaikki' ? 'selected' : '' }}>Kaikki</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}" {{ request('category_name') == $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
            Suodata
        </button>
    </form>



<!-- Strategiaan tallennetut tiketit -->
    <h2 class="text-2xl font-bold text-white mt-10 mb-4">Strategiaan tallennetut tiketit</h2>
    @if ($strategies->count())
        @foreach ($strategies as $strategy)
            <div class="bg-white dark:bg-gray-800 p-4 mb-4 rounded shadow">
                <h3 class="text-lg font-semibold">Aihe: {{ $strategy->feedback->aihe }}</h3>
                <p>Palaute: {{ $strategy->feedback->palaute }}</p>

                @if($strategy->feedback->answers && $strategy->feedback->answers->isNotEmpty())
                    <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded">
                        <h4 class="font-semibold">Vastaukset:</h4>
                        @foreach ($strategy->feedback->answers as $answer)
                            <div class="mt-2">
                                <strong>{{ $answer->employee->name ?? 'Tuntematon' }}:</strong>
                                <p>{{ $answer->answer }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-2 text-gray-500">Ei vastauksia vielä.</p>
                @endif
            </div>
        @endforeach
    @else
        <p>Ei strategiaan tallennettuja tikettejä.</p>
    @endif

    <!-- Ehdotetut tiketit -->
    @if (request()->has('category_name') && $suggestions->count())
    @foreach ($suggestions as $suggestion)
        <div class="bg-white dark:bg-gray-800 p-4 mb-4 rounded shadow">
            <h3 class="text-lg font-semibold">Aihe: {{ $suggestion->feedback->aihe }}</h3>
            <p>Palaute: {{ $suggestion->feedback->palaute }}</p>

            @if($suggestion->feedback->answers && $suggestion->feedback->answers->isNotEmpty())
                <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded">
                    <h4 class="font-semibold">Vastaukset:</h4>
                    @foreach ($suggestion->feedback->answers as $answer)
                        <div class="mt-2">
                            <strong>{{ $answer->employee->name ?? 'Tuntematon' }}:</strong>
                            <p>{{ $answer->answer }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="mt-2 text-gray-500">Ei vastauksia vielä.</p>
            @endif
        </div>
    @endforeach
@elseif(request()->has('category_name'))
    <p>Ei ehdotettuja tikettejä tälle kategorialle.</p>
@endif


</div>

</div>


</body>
</html>
