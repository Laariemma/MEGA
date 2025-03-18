<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Etusivu</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-gray-900 text-white">

    <!-- Navigaatiopalkki -->
    <nav class="bg-gray-800 p-4 flex justify-between">
        <div class="text-xl font-bold">🚀 Laravel</div>
        
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-white hover:text-gray-400">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-400 mr-4">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-white hover:text-gray-400">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- Pääsisältö -->
    <div class="container mx-auto mt-10 p-6">
        <h2 class="text-2xl font-bold mb-4">Anna palautetta</h2>

        <!-- Palautelomake -->
        <form action="/submit" method="POST" class="bg-gray-800 p-6 rounded-lg">
            @csrf
            <label for="aihe" class="block text-sm font-medium text-gray-400">Aihe:</label>
            <input type="text" id="aihe" name="aihe" class="w-full p-2 rounded bg-gray-700 text-white">

            <label for="palaute" class="block mt-4 text-sm font-medium text-gray-400">Palaute:</label>
            <textarea id="palaute" name="palaute" rows="4" class="w-full p-2 rounded bg-gray-700 text-white"></textarea>

            <label for="email" class="block mt-4 text-sm font-medium text-gray-400">Sähköposti:</label>
            <input type="email" id="email" name="email" class="w-full p-2 rounded bg-gray-700 text-white">

            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Lähetä
            </button>
        </form>

        <!-- Saadut palautteet -->
        <h2 class="text-2xl font-bold mt-10">Saadut palautteet:</h2>
        <div class="mt-4 space-y-4">
            @foreach ($feedbacks as $feedback)
                <div class="bg-gray-800 p-4 rounded-lg">
                    <h3 class="text-lg font-bold">{{ $feedback->aihe }}</h3>
                    <p>{{ $feedback->palaute }}</p>
                </div>
            @endforeach
        </div>

        <!-- UKK-linkki -->
        <a href="{{ route('ukk') }}" class="mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Katso usein kysytyt kysymykset
        </a>
    </div>

</body>
</html>
