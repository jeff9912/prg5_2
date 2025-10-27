<x-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">
            Add a New Artist
        </h1>

        <form action="{{ route('artist.store') }}" method="post" class="space-y-5">
            @csrf

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
                <x-input-label for="genre" :value="__('Genre')" class="font-medium !text-black"/>
                <x-text-input
                    id="genre"
                    name="genre"
                    type="text"
                    class="!bg-gray-300 !text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                />
                <x-input-error :messages="$errors->get('genre')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div>
                <x-input-label for="description" :value="__('Description')" class="font-medium !text-black"/>
                <x-text-input
                    id="description"
                    name="description"
                    type="text"
                    class="!bg-gray-300 !text-black dark:bg-gray-300 dark:text-black block p-2 w-full rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required
                />
                <x-input-error :messages="$errors->get('description')" class="mt-2 text-sm text-red-600"/>
            </div>

            <div class="flex justify-center">
                <x-primary-button class="px-6 py-2 text-lg">
                    {{ __('Create Artist') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-layout>
