<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<main>
    <header>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('about') }}">about</a>
        <a href="{{ route('adidas', ['name' => 'adidas']) }}">adidas</a>
        <a href="{{ route('contact') }}">contact</a>
        @auth
            <a href="{{ route('logout') }}">login</a>
        @endauth
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endguest
    </header>
    <main>
        {{ $slot }}
    </main>
</main>
</body>
</html>
