@props(['title' => 'Dockwerk Service', 'mode' => 'portal'])
<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dockwerk Service helpt bedrijven met meldingen en onderhoud aan industriële deuren.">
    <title>{{ $title }} · Dockwerk</title>
    <link rel="icon" href="{{ asset('images/dockwerk-mark.svg') }}" type="image/svg+xml">
    <link rel="preload" href="{{ asset('fonts/mona-sans-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('fonts/mona-sans.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="mode-{{ $mode }}">
    <a href="#inhoud" class="skip-link">Naar inhoud</a>
    <header class="masthead">
        <div class="shell nav">
            <a class="brand" href="{{ route('home') }}" aria-label="Dockwerk, homepage">
                <img src="{{ asset('images/dockwerk-mark.svg') }}" alt="" width="38" height="38">
                <span>Dockwerk<span class="brand-dot">.</span></span>
            </a>
            @if ($mode === 'home')
                <nav class="nav-links" aria-label="Hoofdnavigatie">
                    <a href="#werkwijze">Werkwijze</a>
                    <a href="#onderhoud">Onderhoud</a>
                    <a href="#vragen">Vragen</a>
                </nav>
                <details class="mobile-menu">
                    <summary aria-label="Menu"><x-dock-icon name="list" :size="20" /></summary>
                    <nav aria-label="Mobiele navigatie">
                        <a href="#onderhoud">Onderhoud</a>
                        <a href="#werkwijze">Werkwijze</a>
                        <a href="#vragen">Vragen</a>
                    </nav>
                </details>
            @endif
            @auth
                @if ($mode === 'home')
                    <a class="button button-dark nav-cta" href="{{ route('portal.index') }}">Naar het portaal <x-dock-icon name="up-right" :size="16" /></a>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="button button-quiet" type="submit">Uitloggen <x-dock-icon name="logout" :size="17" /></button>
                    </form>
                @endif
            @else
                @if ($mode !== 'login')
                    <a class="button button-dark nav-cta" href="{{ route('login') }}">Klantportaal <x-dock-icon name="up-right" :size="16" /></a>
                @else
                    <a class="button button-quiet" href="{{ route('home') }}"><x-dock-icon name="back" :size="17" /> Home</a>
                @endif
            @endauth
        </div>
    </header>
    <main id="inhoud" tabindex="-1">{{ $slot }}</main>
    <footer class="footer">
        <div class="shell footer-inner">
            <a class="brand" href="{{ route('home') }}"><img src="{{ asset('images/dockwerk-mark.svg') }}" alt="" width="32" height="32"><span>Dockwerk<span class="brand-dot">.</span></span></a>
            <p>Service voor industriële deuren</p>
            <small>Fictief bedrijf · Portfolioproject</small>
        </div>
    </footer>
</body>
</html>
