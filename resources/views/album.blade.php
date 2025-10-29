<x-layout>

    <h1 class="font-bold py-3 text-2xl">Mijn favoriete Albums</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-6">
        @foreach($albums as $album)
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition">
                <img src="{{ asset($album->picture) }}" alt="{{ $album->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="font-bold text-lg">{{ $album->title }}</h2>
                    <p class="text-gray-600">
                        Duration:
                        {{ floor($album->duration / 60) }}:{{ str_pad($album->duration % 60, 2, '0', STR_PAD_LEFT) }}
                    </p>
                    <p class="text-gray-600">Genre: {{ $album->genre }}</p>
                </div>
            </div>
        @endforeach
    </div>

</x-layout>
