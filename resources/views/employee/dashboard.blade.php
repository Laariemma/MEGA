<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Työntekijä näkymä') }}
        </h2>
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


                                        
                    <img src="https://images.cdn.yle.fi/image/upload/c_crop,h_3375,w_6000,x_0,y_365/ar_1.7777777777777777,c_fill,g_faces,h_431,w_767/dpr_2.0/q_auto:eco/f_auto/fl_lossy/v1728481724/39-1360951670687eb4dc90" 
                         alt="Työntekijän kuva" class="rounded-lg shadow-md mx-auto">

                                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>