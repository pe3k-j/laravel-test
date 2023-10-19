<header>

    <nav>
        @if ($active_item === 'home')
            <span>Home</span>
        @else
            <a href="/">Home</a>
        @endif

        <a href="/awards">Awards</a>
        <a href="/movies">Movies</a>
        <a href="{{ route('about-us') }}">About us</a>
    </nav>

</header>