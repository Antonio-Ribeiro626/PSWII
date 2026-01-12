<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- ADMIN --}}
            @if(auth()->user()->role === 'admin')

                <h3 class="text-2xl font-bold mb-6 text-gray-800">Filmes na base de dados</h3>

                @if($movies->isEmpty())
                    <p class="text-gray-600">Nenhum filme encontrado.</p>
                @else
                    <div class="grid grid-cols-4 gap-6">
                        @foreach($movies as $movie)
                            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                                <img 
                                    src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}" 
                                    alt="{{ $movie->title }}"
                                    class="w-full h-auto object-cover"
                                />
                                <div class="p-4">
                                    <h4 class="font-semibold text-gray-800 mb-3">{{ $movie->title }}</h4>
                                    
                                    <div class="flex gap-2">
                                        <a 
                                            href="{{ route('movies.edit', $movie->id )}}" 
                                            class="flex-1 bg-gray-800 text-white text-center py-2 px-3 rounded-lg hover:bg-gray-700 transition-colors text-sm font-medium"
                                        >
                                            Editar
                                        </a>
                                        
                                        <form
                                            action="{{ route('movies.destroy', $movie->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Tens a certeza que queres apagar este filme?')"
                                            class="flex-1"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                type="submit"
                                                class="w-full bg-red-600 text-white py-2 px-3 rounded-lg hover:bg-red-700 transition-colors text-sm font-medium"
                                            >
                                                Apagar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            {{-- USER NORMAL --}}
            @else

                <h3 class="text-2xl font-bold mb-6 text-gray-800">Meus comentários</h3>

                @if($comments->isEmpty())
                    <p class="text-gray-600">Você ainda não comentou nenhum filme.</p>
                @else
                    <div class="space-y-4">
                        @foreach($comments as $comment)
                            <div class="bg-white p-4 rounded shadow">
                                <p class="font-semibold text-gray-800">
                                    🎬 {{ $comment->movie->title }}
                                </p>
                                <p class="text-gray-600 mt-2">
                                    {{ $comment->body }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                @endif

            @endif

        </div>
    </div>
</x-app-layout>