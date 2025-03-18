<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Työntekijä näkymä') }}
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
                <div class="font-semibold text-xl p-6 text-gray-900 dark:text-gray-100 text-center">

                    
                    <p class="mt-6 text-2xl font-bold leading-relaxed mb-6">
                        {{ __("Olet kirjautunut työntekijänä") }}
                    </p>

                    
                    
                    <div class="mb-8 flex flex-col items-center space-y-4">
                        <button class="w-48 px-4 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700">
                            Vastaa tikettiin
                        </button>
                        <button class="w-48 px-4 py-3 bg-red-500 text-white font-semibold rounded-lg shadow-md hover:bg-red-700">
                            Sulje tiketti
                        </button>
                        <button class="w-48 px-4 py-3 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700">
                            Lähetä tiketti Adminille
                        </button>
                    </div>

                    <h1>Palautteet</h1>

                    @foreach ($feedbacks as $feedback)
                        <!-- Tässä näytetään ne feedbackit, joilla ei vielä ole kategoriaa-->
                        <div style="background-color: yellow; padding: 10px;">
                        <h3 style="color: black;">Aihe: {{ $feedback->aihe }}</h3>
                        <p style="color: black;">Palaute: {{ $feedback->palaute }}</p>
                        <p style="color: black;">Sähköposti: {{ $feedback->email }}</p>

                            <!-- Alhaalla formi, jolla liitetään kategoria-->
                            <form action="{{ route('category.assign', $feedback->id) }}" method="POST">
                                @csrf           <!-- pitää Css:llä muuttaa et näkee noi tekstit paremmin -->
                                <input type="text" name="category" placeholder="Anna kategoria" required>
                                <!-- alempikin myöhemmin css muokkaukseen -->
                                <button style="background-color: white; color: black;" type="submit">Liitä kategoria</button> 
                            </form>

                              <!-- Kommentit -->
                              <div class="mt-4 bg-gray-100 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold">Kommentit:</h3>
                                @foreach ($feedback->comments as $comment)
                                    <div class="bg-gray-200 p-3 mt-2 rounded">
                                        <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}</p>
                                        <!-- Vastaukset -->
                                        @foreach ($comment->replies as $reply)
                                            <div class="ml-6 bg-gray-300 p-2 rounded mt-2">
                                                <p><strong>{{ $reply->user->name }}:</strong> {{ $reply->comment }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                       
                    @endforeach   
                    </div>
                     <!-- Kommenttilomake -->
                     <form method="POST" action="{{ route('comments.store', $feedback->id) }}" class="mt-4">
                                @csrf
                                <textarea name="comment" placeholder="Kirjoita kommentti..." required class="w-full p-2 border rounded"></textarea>
                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded mt-2">Lisää kommentti</button>
                            </form>
                        </div>
                    
                    
                    <img src="https://images.cdn.yle.fi/image/upload/c_crop,h_3375,w_6000,x_0,y_365/ar_1.7777777777777777,c_fill,g_faces,h_431,w_767/dpr_2.0/q_auto:eco/f_auto/fl_lossy/v1728481724/39-1360951670687eb4dc90" 
                         alt="Työntekijän kuva" class="rounded-lg shadow-md mx-auto">

                         

       
                </div>
            </div>
        </div>
    </div>
</x-app-layout>