<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
{{ __('Työntekijä näkymä') }}
</h2>
      
<form method="POST" action="{{ route('logout') }}" class="inline">
@csrf
</form>
</x-slot>

<!-- AVOIMET TIKETIT -->
<h2 class="text-2xl font-bold text-black mb-4">Avoimet tiketit</h2>
@if ($feedbacks->count())
@foreach ($feedbacks as $feedback)
@if ($feedback->status == 'open')
<div class="bg-gray-700 p-4 mb-6 rounded-lg">
<h3 class="text-white font-semibold">Aihe: {{ $feedback->aihe }}</h3>
<p class="text-white">Palaute: {{ $feedback->palaute }}</p>
<p class="text-white">Sähköposti: {{ $feedback->email }}</p>

<!-- Kommentointi -->
@if ($feedback->comments->count())
<div class="mt-4 p-3 bg-gray-600 rounded-lg">
<h4 class="text-white font-semibold">Kommentit:</h4>
@foreach ($feedback->comments as $comment)
<p class="text-gray-300">💬 <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
@endforeach
</div>
@endif
<!-- Vastaus asiakkaalle -->
@if ($feedback->status == 'open')
<form action="{{ route('feedback.answer', ['id' => $feedback->id]) }}" method="POST" class="mt-4">
@csrf
<textarea name="answers" rows="3" class="w-full p-2 rounded-lg" placeholder="Kirjoita vastaus asiakkaalle"></textarea>
<button type="submit" class="mt-2 px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-700">
Lähetä vastaus asiakkaalle
</button>
</form>
@endif

<!-- Lisää kommentti -->
<form action="{{ route('comments.store', ['id' => $feedback->id]) }}" method="POST" class="mt-4">
@csrf
<textarea name="comment" rows="2" class="w-full p-2 rounded-lg" placeholder="Lisää kommentti"></textarea>

<div class="flex space-x-2 mt-2">
<button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
Lähetä kommentti
</button>
<form action="{{ route('feedback.suggest', ['id' => $feedback->id]) }}" method="POST" class="inline">
@csrf
<button type="submit" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-700">
Siirrä ehdotuksena adminille
</button>
</form>
<form action="{{ route('ticket.close', ['id' => $feedback->id]) }}" method="POST" class="inline">
@csrf
<button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
Sulje tiketti
</button>
</form>
</div>


<!-- Ehdotus adminille -->
<form action="{{ route('feedback.suggest', ['id' => $feedback->id]) }}" method="POST" class="inline mt-4">
@csrf
</form>

<!-- Sulje tiketti -->
<form action="{{ route('ticket.close', ['id' => $feedback->id]) }}" method="POST" class="inline mt-4">
@csrf
</form>
</div>
@endif
@endforeach
@else
<p class="text-gray-500">Ei avoimia tikettejä.</p>
@endif

<h2 class="text-2xl font-bold text-black mb-4">Vastatut tiketit</h2>
@if ($answeredTickets->count())
@foreach ($answeredTickets as $ticket)
<div class="bg-gray-700 p-4 mb-6 rounded-lg">
<h3 class="text-white font-semibold">Aihe: {{ $ticket->aihe }}</h3>
<p class="text-white">Palaute: {{ $ticket->palaute }}</p>
<p class="text-white">Sähköposti: {{ $ticket->email }}</p>
@foreach ($ticket->answers as $answer)
<p class="text-green-200">📬 <strong>{{ $answer->employee->name ?? 'Tuntematon' }}:</strong> {{ $answer->answer }}</p>
@endforeach

<form action="{{ route('feedback.suggest', ['id' => $ticket->id]) }}" method="POST" class="inline mt-4">
@csrf
<button type="submit" class="mt-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-700">
Siirrä ehdotuksena adminille
</button>
</form>
<form action="{{ route('ticket.close', ['id' => $ticket->id]) }}" method="POST" class="inline">
@csrf
<button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
Sulje tiketti
</button>
</form>
</div>

<!-- Kommentit -->
@if ($ticket->comments->count())
<div class="mt-4 p-3 bg-gray-600 rounded-lg">
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

<!-- SULJETUT TIKETIT -->
<h2 class="text-2xl font-bold text-black mt-10 mb-4">Suljetut tiketit</h2>
@if ($closedTickets->count())
@foreach ($closedTickets as $closed)
<div class="bg-gray-800 p-4 mb-6 rounded-lg">
<h3 class="text-white font-semibold">Aihe: {{ $closed->feedback->aihe }}</h3>
<p class="text-white">Palaute: {{ $closed->feedback->palaute }}</p>
<p class="text-white">Sähköposti: {{ $closed->feedback->email }}</p>
<p class="text-gray-400 text-sm">Suljettu: {{ $closed->created_at->format('d.m.Y H:i') }}</p>
</div>
@endforeach
@else
<p class="text-gray-500">Ei suljettuja tikettejä.</p>
@endif

<!-- SUGGESTION TIKETIT -->
<h2 class="text-2xl font-bold text-black mt-10 mb-4">Ehdotetut tiketit</h2>
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

<!-- Lisää kommentti -->
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