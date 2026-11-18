<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TastyFood')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('news.index') }}">News</a></li>
                <li><a href="{{ route('gallery.index') }}">Gallery</a></li>
                <li><a href="{{ route('contact.index') }}">Contact</a></li>
                

                @auth
                    @if(auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.index') }}">Admin Dashboard</a></li>
                    @endif
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </nav>
    </header>

    <main>
    @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} TastyFood. All rights reserved.</p>
    </footer>
</body>
</html>