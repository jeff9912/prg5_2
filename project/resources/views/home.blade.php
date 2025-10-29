<x-layout>
    <h1 class="font-bold py-3 text-2xl">Mijn favorite Artists</h1>

    <div class="py-4">
        @foreach(['Rock', 'Metal', 'Pop', 'Jazz', 'Classical', 'Alternative', 'Hip-Hop'] as $genre)
            <a href="{{ route("artist.filter", ['genre' => $genre]) }}"
               class="filter_button px-4 py-2 mr-2 rounded {{ isset($selectedGenre) && $selectedGenre == $genre ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                {{ $genre }}
            </a>
        @endforeach
    </div>

    <div id="artist_table">
        <table class="border-collapse border border-gray-300 w-full">
            <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Genre</th>
                <th class="border border-gray-300 px-4 py-2">Hide</th>
                <th class="border border-gray-300 px-4 py-2">Remove</th>
                <th class="border border-gray-300 px-4 py-2">View</th>
                <th class="border border-gray-300 px-4 py-2">Edit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($artists as $artist)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">{{ $artist->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $artist->artist_name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $artist->genre }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if(auth()->check() && (auth()->user()->admin || auth()->id() == $artist->user_id))
                            <form action="{{ route('artist.toggleHidden', $artist->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="{{ $artist->hidden ? 'text-green-600' : 'text-yellow-600' }} hover:underline">
                                    {{ $artist->hidden ? 'Unhide' : 'Hide' }}
                                </button>
                            </form>
                        @else
                            can't toggle
                        @endif
                    </td>
                    @if(auth()->check() && (auth()->user()->admin || auth()->id() == $artist->user_id))
                        <td class="border border-gray-300 px-4 py-2">
                            <form action="{{ route('artist.destroy', $artist->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    @else
                        <td class="border border-gray-300 px-4 py-2"> can't delete
                        </td>
                    @endif
                    <td class="border border-gray-300 px-4 py-2">
                        <a class="hover:underline text-blue-600" href="{{ route('artist.show', $artist->id) }}">View</a>
                    </td>
                    @if(auth()->check() && (auth()->user()->admin || auth()->id() == $artist->user_id))
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('artist.edit', $artist->id) }}"
                               class="text-blue-600 hover:underline">Edit</a>
                        </td>
                    @else
                        <td class="border border-gray-300 px-4 py-2">can't edit</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{--    script for filtering by genre--}}
    <script src="{{ asset('js/home.js') }}"></script>
</x-layout>

