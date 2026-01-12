<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- ADMIN --}}
            @if(auth()->user()->role === 'admin')

                <h3 class="text-2xl font-bold mb-6">Filmes na base de dados</h3>

                @if($movies->isEmpty())
                    <p>Nenhum filme encontrado.</p>
                @else
                    <div class="cards-2">
                        @foreach($movies as $movie)
                            <div class=" card">
                                <img src="https://image.tmdb.org/t/p/w500{{ $movie->poster_path }}"  />
                                <div class="p-4">
                                    <h4 class="font-semibold">{{ $movie->title }}</h4>
                                </div>
                                <div class="flex gap-2 mt-3">

                   
                        <div class="elements-crud">
                          <a  class="btn-db  " href="{{ route('movies.edit', $movie->id )}}" >
                                editar
                        </a>
                                <form
                                    action="{{ route('movies.destroy', $movie->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Tens a certeza que queres apagar este filme?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="btn-db "
                                    >
                                         Apagar
                                    </button>
                                </form>
                    </div>

                            </div>
                        @endforeach
                    </div>
                @endif

            {{-- USER NORMAL --}}
            @else

                <h3 class="text-2xl font-bold mb-6">Meus comentários</h3>

                @if($comments->isEmpty())
                    <p>Você ainda não comentou nenhum filme.</p>
                @else
                    <div class="space-y-4 gap-3">
                        @foreach($comments as $comment)
                            <div class="bg-white p-4 rounded shadow">
                                <p class="font-semibold">
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
