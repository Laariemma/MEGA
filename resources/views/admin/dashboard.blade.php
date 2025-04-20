<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

   <!-- Vastatut tiketit -->
<h2 class="text-2xl font-bold text-white mt-10 mb-4">Vastatut tiketit</h2>

@if ($answeredTickets->count())
    @foreach ($answeredTickets as $ticket)
        <div class="bg-green-700 p-4 mb-6 rounded-lg">
            <h3 class="text-white font-semibold">Aihe: {{ $ticket->aihe }}</h3>
            <p class="text-white">Palaute: {{ $ticket->palaute }}</p>
            <p class="text-white">Sähköposti: {{ $ticket->email }}</p>

            <!-- Vastaukset -->
            @foreach ($ticket->answers as $answer)
                <p class="text-green-200">📬 <strong>{{ $answer->employee->name ?? 'Tuntematon' }}:</strong> {{ $answer->answer }}</p>
            @endforeach

            <!-- Kommentit -->
            @if ($ticket->comments->count())
                <div class="mt-4 p-3 bg-green-600 rounded-lg">
                    <h4 class="text-white font-semibold">Kommentit:</h4>
                    @foreach ($ticket->comments as $comment)
                        <p class="text-gray-300">💬 <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                    @endforeach
                </div>
            @endif

            <!-- Kommentointi -->
            <form action="{{ route('comments.store', ['id' => $ticket->id]) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="comment" rows="2" class="w-full p-2 rounded-lg" placeholder="Lisää kommentti"></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    Lähetä kommentti
                </button>
            </form>
        </div>
    @endforeach
@else
    <p class="text-gray-500">Ei vastattuja tikettejä.</p>
@endif

    <!-- Ehdotukset -->
    <h2 class="text-2xl font-bold text-white mt-10 mb-4">Ehdotetut tiketit</h2>

@if ($suggestions->count())
    @foreach ($suggestions as $suggestion)
        <div class="bg-gray-700 p-4 mb-6 rounded-lg">
            <h3 class="text-white font-semibold">Aihe: {{ $suggestion->feedback->aihe }}</h3>
            <p class="text-white">Palaute: {{ $suggestion->feedback->palaute }}</p>
            <p class="text-white">Sähköposti: {{ $suggestion->feedback->email }}</p>

            <!-- Kommentit -->
            @foreach ($suggestion->feedback->comments as $comment)
                <p class="text-gray-300">💬 <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
            @endforeach

            <!-- Kommentointi -->
            <form action="{{ route('comments.store', ['id' => $suggestion->feedback->id]) }}" method="POST" class="mt-4">
                @csrf
                <textarea name="comment" rows="2" class="w-full p-2 rounded-lg" placeholder="Lisää kommentti"></textarea>
                <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                    Lähetä kommentti
                </button>
            </form>
        </div>
    @endforeach
@else
    <p class="text-gray-500">Ei ehdotuksia.</p>
@endif
</x-app-layout>