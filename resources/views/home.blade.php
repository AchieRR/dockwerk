<x-layout title="Onderhoud aan industriële deuren" mode="home">
    @php
        $portalUrl = auth()->check() ? route('portal.index') : route('login');
        $lightIntro = request()->query('intro') === 'licht';
    @endphp

    <section @class(['cover', 'cover-lit' => $lightIntro]) aria-labelledby="hero-title">
        <picture class="cover-picture">
            <source media="(max-width: 620px)" srcset="{{ asset('images/dockwerk-avond-mobiel.webp') }}">
            <img class="hero-photo" src="{{ asset('images/dockwerk-avond.webp') }}" alt="" fetchpriority="high" width="1536" height="1024">
        </picture>
        @unless ($lightIntro)
            <div class="cover-shutter" aria-hidden="true"></div>
        @endunless
        <div class="shell cover-content">
            <h1 id="hero-title">dockwerk<span class="sr-only"> · Service voor bedrijfsdeuren</span></h1>
            <div class="cover-meta">
                <a class="cover-jump" href="#onderhoud"><span aria-hidden="true">↓</span> Bekijk onze service</a>
                <p>Onderhoud en storingen aan industriële deuren. Volg de afspraak en afhandeling in je klantportaal.</p>
            </div>
        </div>
    </section>

    <section id="onderhoud" class="shell service-section" aria-labelledby="maintenance-title">
        <div class="service-intro">
            <h2 id="maintenance-title" data-appear>Onderhoud aan bedrijfsdeuren.</h2>
            <p data-appear>Voor bedrijven met laadperrons, magazijnen en werkplaatsen. Dockwerk brengt je deuren en servicehistorie bij elkaar, ook als je meerdere locaties beheert.</p>
        </div>
        <article class="service-pair">
            <figure class="service-image"><img class="service-photo" src="{{ asset('images/laadperron.webp') }}" alt="Drie bedrijfsdeuren aan het laadperron van een distributiehal" loading="lazy" width="1536" height="1024"></figure>
            <div class="service-sheet" data-appear>
                <x-dock-icon name="alert" :size="25" class="service-icon" />
                <h3>Als een deur stilvalt.</h3>
                <p>Kies de deur en beschrijf wat er gebeurt. Je melding krijgt een eigen nummer, zodat de werkplaats hem meteen bij de juiste locatie kan terugvinden.</p>
                <a class="studio-link" href="{{ $portalUrl }}">Storing melden <x-dock-icon name="up-right" :size="16" /></a>
            </div>
        </article>
        <article class="service-pair service-pair-reverse">
            <figure class="service-image"><img class="service-photo" src="{{ asset('images/onderhoud.webp') }}" alt="Een monteur inspecteert de geleider van een industriële deur" loading="lazy" width="1100" height="734"></figure>
            <div class="service-sheet" data-appear>
                <x-dock-icon name="door" :size="25" class="service-icon" />
                <h3>Grip op elke locatie.</h3>
                <p>Open het overzicht van je bedrijf. Je ziet de geregistreerde deuren, hun locatie en de voortgang van iedere gemelde storing.</p>
                <a class="studio-link" href="{{ $portalUrl }}">Naar je deuren <x-dock-icon name="up-right" :size="16" /></a>
            </div>
        </article>
    </section>

    <section id="werkwijze" class="workflow-section" aria-labelledby="workflow-title">
        <div class="shell workflow-inner">
            <div class="workflow-copy" data-appear>
                <h2 id="workflow-title">Van storing<br>tot herstel.</h2>
                <p>Kies een status bij de voorbeeldmelding en zie wat er in het klantportaal verschijnt.</p>
                <a class="button studio-primary" href="{{ $portalUrl }}">Open klantportaal <x-dock-icon name="up-right" :size="17" /></a>
            </div>
            <x-workflow-preview />
        </div>
    </section>

    <section id="vragen" class="shell faq-section" aria-labelledby="faq-title">
        <div data-appear><h2 id="faq-title">Vragen over<br>het portaal.</h2><p>Van de eerste melding tot het terugvinden van je afspraak.</p></div>
        <div class="faq-list" data-appear>
            <details name="dock-faq">
                <summary>Welke deur kan ik melden? <span aria-hidden="true"></span></summary>
                <p>Je ziet de deuren van je eigen bedrijf. In het meldformulier kies je de juiste deur op naam en locatie.</p>
            </details>
            <details name="dock-faq">
                <summary>Waar vind ik mijn afspraakdatum? <span aria-hidden="true"></span></summary>
                <p>Open de melding vanuit het overzicht. Zodra een medewerker een datum heeft vastgelegd, staat die onder Afspraak.</p>
            </details>
            <details name="dock-faq">
                <summary>Wat gebeurt er als de storing is verholpen? <span aria-hidden="true"></span></summary>
                <p>De melding krijgt de status Afgerond. Je houdt toegang tot de tijdlijn met de datum en een eventuele toelichting.</p>
            </details>
        </div>
    </section>

    <section class="closing-section" aria-labelledby="closing-title">
        <div class="shell closing-inner" data-appear>
            <h2 id="closing-title">Een deur buiten bedrijf?</h2>
            <a class="button closing-button" href="{{ $portalUrl }}">Naar het klantportaal <x-dock-icon name="up-right" :size="17" /></a>
        </div>
    </section>
</x-layout>
