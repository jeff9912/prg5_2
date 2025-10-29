<x-layout>

    <h1 class="font-bold text-2xl py-1">Name:</h1>
    <h1> {{ $artist->artist_name }}</h1>

    <h1 class="font-bold text-2xl py-1">Genre:</h1>
    <h1> {{ $artist->genre }}</h1>

    <h1 class="font-bold text-2xl py-1">Description</h1>
    <h1> {{ $artist->description }}</h1>

</x-layout>
