<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">
<main class="flex-grow">

    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="max-w-6xl mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Left: Logo or site name -->
            <div class="text-2xl font-bold text-black-600">
                <a href="{{ route('home') }}">Jeff's favorite music !</a>
            </div>

            <!-- Center: Navigation links -->
            <div class="flex space-x-6">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
                <a href="{{ route('albums') }}" class="hover:text-blue-600 transition">Albums</a>
                <a href="{{ route('about') }}" class="hover:text-blue-600 transition">About</a>
                <a href="{{ route('contact') }}" class="hover:text-blue-600 transition">Contact</a>
            </div>

            <!-- Right: Auth buttons -->
            <div class="flex items-center space-x-4">
                @auth
                    <a class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition"
                       href="{{ route('artist.create') }}">New artist</a>
                    <a class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-500 transition"
                       href="{{ route('albums.create') }}">New album</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                            Logout
                        </button>
                    </form>
                @endauth

                @guest
                    <a href="{{ route('login') }}"
                       class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 bg-gray-200 rounded-md hover:bg-gray-300 transition">
                        Register
                    </a>
                @endguest
            </div>
        </nav>
    </header>

    <!-- Page content -->
    <section class="max-w-6xl mx-auto px-6 py-12">
        {{ $slot }}
    </section>

</main>

<!-- Footer -->
<footer class="bg-white border-t text-center py-4 text-sm text-gray-500">
    © {{ date('Y') }} Jeff's site.
</footer>

</body>
</html>
