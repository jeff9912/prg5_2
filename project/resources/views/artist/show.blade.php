<x-layout>

    <h1 class="font-bold text-center text-4xl">Name:</h1>
    <h1> {{ $artist->artist_name }}</h1>

    <h1 class="font-bold text-center text-4xl">Genre:</h1>
    <h1> {{ $artist->genre }}</h1>

    <h1 class="font-bold text-center text-4xl">Description</h1>
    <h1> {{ $artist->description }}</h1>

</x-layout>
