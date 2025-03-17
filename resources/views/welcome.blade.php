<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

       
        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
           
        @endif
    </head>
   
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
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
                    </header>
                    <body>

<h2>Anna palautetta</h2>

<form action="/submit" method="POST">
    @csrf
    <label for="aihe">Aihe:</label><br>
    <input type="text" id="aihe" name="aihe"><br><br>
    <label for="palaute">Palaute:</label><br>
    <textarea id="palaute" name="palaute" rows="10" cols="30"></textarea><br><br>
    <label for="email">Sähköposti:</label><br>
    <input type="email" id="email" name="email"><br><br>
    <input type="submit" value="Submit"><br><br>
</form>
<h2>Saadut palautteet:</h2>
    @foreach ($feedbacks as $feedback)
        <div>
            <h3>{{ $feedback->aihe }}</h3>
            <p>{{ $feedback->palaute }}</p>
        </div>
    @endforeach

<a
    href="{{ route('ukk') }}"
    class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
>
    Katso usein kysytyt kysymykset
</a>


</body>

</html>
