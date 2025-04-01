<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin näkymä') }}
        </h2>

        <a href="{{ url('/') }}" class="text-white hover:text-gray-400">Etusivu</a>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-white hover:text-gray-400">Kirjaudu ulos</button>
        </form>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">Admin palautteet</h1>

                    @if ($feedbacks && $feedbacks->count() > 0)
                        @foreach ($feedbacks as $feedback)
                            <div class="bg-gray-700 p-4 mb-6 rounded-lg">
                                <h3 class="text-white font-semibold">Aihe: {{ $feedback->aihe }}</h3>
                                <p class="text-white">Palaute: {{ $feedback->palaute }}</p>
                                <p class="text-white">Sähköposti: {{ $feedback->email }}</p>

                                <!-- Näytä työntekijän kommentit -->
                                @if ($feedback->comments && $feedback->comments->isNotEmpty())
                                    <div class="mt-4 p-3 bg-gray-600 rounded-lg">
                                        <h4 class="text-white font-semibold">Kommentit:</h4>
                                        @foreach ($feedback->comments as $comment)
                                            <p class="text-gray-300">💬 <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Admin voi lisätä oman vastauksensa -->
                                <form action="{{ route('comments.store', ['id' => $feedback->id]) }}" method="POST" class="mt-4">
    @csrf
    <input type="hidden" name="parent_id" value=""> <!-- Jos kommentti ei ole vastaus -->
    <textarea name="comment" rows="2" class="w-full p-2 rounded-lg" placeholder="Kirjoita vastaus..."></textarea>
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
        Lähetä vastaus
    </button>
</form>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">Ei palautteita saatavilla.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
