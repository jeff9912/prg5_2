<x-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">
            Update Artist
        </h1>

        <form action="{{ route('artist.update', $artist->id) }}" method="post" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="artist_name" :value="__('Artist Name')" class="font-medium !text-black"/>
                <x-text-input
                    id="artist_name"
                    name="artist_name"
                    type="text"
                    value="{{ old('artist_name', $artist->artist_name) }}"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                />
                <x-input-error :messages="$errors->get('artist_name')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div>
                <x-input-label for="genre" :value="__('Genre')" class="font-medium !text-black"/>
                <select
                    id="genre"
                    name="genre"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                >
                    <option value="">-- Select Genre --</option>
                    @foreach(['Rock','Classical','Alternative','Pop','Metal','Jazz','Hip-Hop'] as $g)
                        <option
                            value="{{ $g }}" {{ old('genre', $artist->genre) == $g ? 'selected' : '' }}>{{ $g }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('genre')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" class="font-medium !text-black"/>
                <x-text-input
                    id="description"
                    name="description"
                    type="text"
                    value="{{ old('description', $artist->description) }}"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                />
                <x-input-error :messages="$errors->get('description')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div class="flex justify-center">
                <x-primary-button class="px-6 py-2 text-lg">
                    {{ __('Update Artist') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layout>
