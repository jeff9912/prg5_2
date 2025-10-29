<x-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">
            Add a New Album
        </h1>

        <form action="{{ route('albums.store') }}" method="post" class="space-y-5" enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="title" :value="__('Album Title')" class="font-medium !text-black"/>
                <x-text-input
                    id="title"
                    name="title"
                    type="text"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                />
                <x-input-error :messages="$errors->get('title')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div>
                <x-input-label for="artist_name" :value="__('Artist Name')" class="font-medium !text-black"/>
                <x-text-input
                    id="artist_name"
                    name="artist_name"
                    type="text"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                />
                <x-input-error :messages="$errors->get('artist_name')" class="mt-2 text-sm text-red-600"/>
            </div>


            <div>
                <x-input-label for="picture" :value="__('Album Cover (url)')" class="font-medium !text-black"/>
                <x-text-input
                    id="picture"
                    name="picture"
                    type="text"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                />
                <x-input-error :messages="$errors->get('picture')" class="mt-2 text-sm text-red-600"/>
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
                    <option value="Rock" {{ old('genre') == 'Rock' ? 'selected' : '' }}>Rock</option>
                    <option value="Classical" {{ old('genre') == 'Classical' ? 'selected' : '' }}>Classical</option>
                    <option value="Alternative" {{ old('genre') == 'Alternative' ? 'selected' : '' }}>Alternative
                    </option>
                    <option value="Pop" {{ old('genre') == 'Pop' ? 'selected' : '' }}>Pop</option>
                    <option value="Metal" {{ old('genre') == 'Metal' ? 'selected' : '' }}>Metal</option>
                    <option value="Jazz" {{ old('genre') == 'Jazz' ? 'selected' : '' }}>Jazz</option>
                    <option value="Hip-Hop" {{ old('genre') == 'Hip-Hop' ? 'selected' : '' }}>Hip-Hop</option>
                </select>
                <x-input-error :messages="$errors->get('genre')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div>
                <x-input-label for="duration" :value="__('Duration (in seconds)')" class="font-medium !text-black"/>
                <x-text-input
                    id="duration"
                    name="duration"
                    type="number"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                    />
                <x-input-error :messages="$errors->get('duration')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div class="flex justify-center">
                <x-primary-button class="px-6 py-2 text-lg">
                    {{ __('Create Album') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layout>
