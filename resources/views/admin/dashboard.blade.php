<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin sivu</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
</head>
<body>
                    <a href="{{ url('/') }}" class="text-white hover:text-gray-400">Etusivu</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                     @csrf
                    <button type="submit" class="text-white hover:text-gray-400">Kirjaudu ulos</button>
                    </form>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('employee.dashboard') }}">Työntekijä näkymä</a></li>
                
            </ul>
        </nav>
    </header>

    <main>
        <h2>Admin sivusto</h2>
        
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <h3>Saadut palautteet</h3>
        <table border="1">
            <tr>
                <th>Aihe</th>
                <th>Palaute</th>
                <th>Toiminnot</th>
            </tr>
            @foreach ($feedbacks as $feedback)
                <tr>
                    <td>{{ $feedback->aihe }}</td>
                    <td>{{ $feedback->palaute }}</td>
                    <td>
                        <a href="{{ route('admin.feedbacks.edit', $feedback->id) }}">Muokkaa</a>
                        <form action="{{ route('admin.feedbacks.delete', $feedback->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" onclick="return confirm('Haluatko varmasti poistaa tämän palautteen?')">Poista</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </main>
</body>
</html>