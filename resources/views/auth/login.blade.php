<x-layout title="Inloggen" mode="login">
    <div class="shell login-shell">
        <section class="login-image" aria-labelledby="login-intro">
            <img src="{{ asset('images/laadperron.webp') }}" alt="" width="1536" height="1024">
            <div class="login-overlay"></div>
            <div class="login-intro">
                <p class="eyebrow hero-kicker"><span></span> Dockwerk Service</p>
                <h1 id="login-intro">Service aan je deuren.</h1>
                <p>Meld een storing en volg de afhandeling op één plek.</p>
            </div>
        </section>
        <section class="login-form-card" aria-labelledby="login-title">
            <p class="eyebrow section-kicker">Klantportaal</p>
            <h2 id="login-title">Welkom terug.</h2>
            <p class="muted">Log in om je meldingen te bekijken.</p>
            <form method="POST" action="{{ route('login.store') }}" id="login-form" class="stacked-form">
                @csrf
                <label for="email">E-mailadres</label>
                <input id="email" name="email" type="email" required autocomplete="username" value="{{ old('email') }}" @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                <x-field-error field="email" />
                <label for="password">Wachtwoord</label>
                <input id="password" name="password" type="password" required autocomplete="current-password" @error('password') aria-invalid="true" aria-describedby="password-error" @enderror>
                <x-field-error field="password" />
                <button class="button button-dark full-button" type="submit">Inloggen <x-dock-icon name="arrow" :size="18" /></button>
            </form>
            @if (config('dockwerk.demo') && app()->environment(['local', 'testing']))
                <aside class="demo-box" aria-labelledby="demo-title">
                    <h3 id="demo-title">Probeer de demo</h3>
                    <p>Kies een account om de inlogvelden in te vullen.</p>
                    <div class="demo-actions">
                        <button type="button" data-demo-email="noordkade@dockwerk.test">Noordkade</button>
                        <button type="button" data-demo-email="ijsselhaven@dockwerk.test">IJsselhaven</button>
                        <button type="button" data-demo-email="werkplaats@dockwerk.test">Medewerker</button>
                    </div>
                    <noscript><p>Gebruik noordkade@dockwerk.test, ijsselhaven@dockwerk.test of werkplaats@dockwerk.test met wachtwoord dockwerk-demo.</p></noscript>
                </aside>
            @endif
        </section>
    </div>
</x-layout>
