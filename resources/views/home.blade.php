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
            <span class="studio-label">Onderhoud & service</span>
            <div data-appear><h2 id="maintenance-title">Een deur die werkt.<br>Een werkplaats die door kan.</h2><p>Voor bedrijven met laadperrons, magazijnen en werkplaatsen. Dockwerk brengt je deuren en servicehistorie bij elkaar, ook als je meerdere locaties beheert.</p></div>
        </div>
        <article class="service-pair" data-appear>
            <figure class="service-image"><img class="service-photo" src="{{ asset('images/laadperron.webp') }}" alt="Drie bedrijfsdeuren aan het laadperron van een distributiehal" loading="lazy" width="1536" height="1024"></figure>
            <div class="service-sheet">
                <div class="sheet-top"><span>01 / Storingen</span><x-dock-icon name="alert" :size="19" /></div>
                <h3>Als een deur stilvalt.</h3>
                <p>Kies de deur en beschrijf wat er gebeurt. Je melding krijgt een eigen nummer, zodat de werkplaats hem meteen bij de juiste locatie kan terugvinden.</p>
                <a class="studio-link" href="{{ $portalUrl }}">Storing melden <x-dock-icon name="up-right" :size="16" /></a>
            </div>
        </article>
        <article class="service-pair service-pair-reverse" data-appear>
            <figure class="service-image"><img class="service-photo" src="{{ asset('images/onderhoud.webp') }}" alt="Een monteur inspecteert de geleider van een industriële deur" loading="lazy" width="1100" height="734"></figure>
            <div class="service-sheet">
                <div class="sheet-top"><span>02 / Bedrijfsdeuren</span><x-dock-icon name="door" :size="19" /></div>
                <h3>Grip op elke locatie.</h3>
                <p>Open het overzicht van je bedrijf. Je ziet de geregistreerde deuren, hun locatie en de voortgang van iedere gemelde storing.</p>
                <a class="studio-link" href="{{ $portalUrl }}">Naar je deuren <x-dock-icon name="up-right" :size="16" /></a>
            </div>
        </article>
    </section>

    <section id="werkwijze" class="workflow-section" aria-labelledby="workflow-title">
        <div class="shell workflow-inner">
            <div data-appear>
                <p class="studio-label">In het klantportaal</p>
                <h2 id="workflow-title">Van storing<br>tot herstel.</h2>
                <p>Je ziet zodra de werkplaats iets verandert precies wat er is gebeurd en wat je kunt verwachten.</p>
                <a class="button studio-primary" href="{{ $portalUrl }}">Open klantportaal <x-dock-icon name="up-right" :size="17" /></a>
            </div>
            <ol class="studio-steps" aria-label="Stappen in een servicemelding">
                <li data-appear><span aria-hidden="true">01</span><div><h3>Meld de storing</h3><p>Selecteer de bedrijfsdeur en beschrijf het probleem.</p></div><x-dock-icon name="list" /></li>
                <li data-appear><span aria-hidden="true">02</span><div><h3>Bekijk je afspraak</h3><p>De werkplaats zet de geplande datum bij je melding.</p></div><x-dock-icon name="calendar" /></li>
                <li data-appear><span aria-hidden="true">03</span><div><h3>Lees de terugkoppeling</h3><p>In de tijdlijn vind je de afronding en de toelichting.</p></div><x-dock-icon name="check" /></li>
            </ol>
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
