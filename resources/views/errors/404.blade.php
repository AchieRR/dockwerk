<x-layout title="Pagina niet gevonden">
    <div class="shell narrow-shell">
        <section class="panel form-panel">
            <p class="eyebrow section-kicker">404</p>
            <h1>Pagina niet gevonden.</h1>
            <p class="muted">Deze pagina is niet beschikbaar.</p>
            <a class="button button-dark" href="{{ auth()->check() ? route('portal.index') : route('home') }}">Ga naar het overzicht <x-dock-icon name="arrow" :size="18" /></a>
        </section>
    </div>
</x-layout>
