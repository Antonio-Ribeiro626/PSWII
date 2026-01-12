<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Filme
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                
                <!-- Header com Poster -->
                <div class="bg-gradient-to-r from-gray-800 to-gray-900 p-6">
                    <div class="flex items-center gap-6">
                        @if($movie->poster_path)
                            <img 
                                src="https://image.tmdb.org/t/p/w200{{ $movie->poster_path }}" 
                                alt="{{ $movie->title }}"
                                class="w-24 h-36 object-cover rounded-lg shadow-xl"
                            />
                        @endif
                        <div>
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $movie->title }}</h3>
                            <p class="text-gray-300 text-sm">ID: {{ $movie->id }} | TMDB ID: {{ $movie->tmdb_id }}</p>
                        </div>
                    </div>
                </div>

                <!-- Formulário -->
                <form action="{{ route('movies.update', $movie->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Título -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Título
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $movie->title) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                            required
                        />
                    </div>

                    <!-- Sinopse -->
                    <div>
                        <label for="overview" class="block text-sm font-medium text-gray-700 mb-2">
                            Sinopse
                        </label>
                        <textarea 
                            name="overview" 
                            id="overview" 
                            rows="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                        >{{ old('overview', $movie->overview) }}</textarea>
                    </div>

                    <!-- Grid: Data e Rating -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Data de Lançamento -->
                        <div>
                            <label for="release_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Data de Lançamento
                            </label>
                            <input 
                                type="date" 
                                name="release_date" 
                                id="release_date" 
                                value="{{ old('release_date', $movie->release_date) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                            />
                        </div>

                        <!-- Rating -->
                        <div>
                            <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">
                                Avaliação (0-10)
                            </label>
                            <input 
                                type="number" 
                                name="rating" 
                                id="rating" 
                                step="0.1" 
                                min="0" 
                                max="10"
                                value="{{ old('rating', $movie->rating) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                            />
                        </div>
                    </div>

                    <!-- Gêneros -->
                    <div>
                        <label for="genres" class="block text-sm font-medium text-gray-700 mb-2">
                            Géneros 
                        </label>
                        <input 
                            type="text" 
                            name="genres" 
                            id="genres" 
                            value="{{ old('genres', $movie->genres) }}"
                            placeholder="Ação, Aventura, Ficção Científica"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-800 focus:border-transparent"
                        />
                    </div>

                    <!-- TMDB ID -->
                    <div>
                        <label for="tmdb_id" class="block text-sm font-medium text-gray-700 mb-2">
                            TMDB ID
                        </label>
                        <input 
                            type="text" 
                            name="tmdb_id" 
                            id="tmdb_id" 
                            value="{{ $movie->tmdb_id }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg bg-gray-100 cursor-not-allowed"
                            readonly
                        />
                    </div>

                    <!-- Botões -->
                    <div class="flex gap-4 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 bg-gray-800 text-white py-3 px-6 rounded-lg hover:bg-gray-700 transition-colors font-medium"
                        >
                             Salvar Alterações
                        </button>
                        
                        <a 
                            href="{{ route('dashboard') }}"
                            class="flex-1 bg-gray-200 text-gray-800 py-3 px-6 rounded-lg hover:bg-gray-300 transition-colors font-medium text-center"
                        >
                             Cancelar
                        </a>
                    </div>
                </form>

            </div>

        </div>
    </div>
</x-app-layout>