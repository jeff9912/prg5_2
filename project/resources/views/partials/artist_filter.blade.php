<table class="border-collapse border border-gray-300 w-full">
    <thead>
    <tr class="bg-gray-200">
        <th>ID</th>
        <th>Name</th>
        <th>Genre</th>
        <th>Hide</th>
        <th>Remove</th>
        <th>Link</th>
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
        </tr>
    @endforeach
    </tbody>
</table>
