<x-layout title="Onderhoud aan industriële deuren" mode="home">
    <section class="shell studio-intro" aria-labelledby="hero-title">
        <div><p class="studio-label">Dockwerk Service / Friesland</p><h1 id="hero-title">Service voor <br>bedrijfsdeuren.</h1></div>
        <div class="studio-lead">
            <p>Meld een storing aan je deur en volg de afspraak en afhandeling in het klantportaal.</p>
            <a class="button studio-primary" href="{{ auth()->check() ? route('portal.index') : route('login') }}">Open klantportaal <x-dock-icon name="up-right" :size="17" /></a>
        </div>
    </section>

    <figure class="shell studio-feature">
        <div><img class="hero-photo" src="{{ asset('images/laadperron.webp') }}" alt="Drie bedrijfsdeuren aan het laadperron van een distributiehal" fetchpriority="high" width="1536" height="1024"></div>
        <figcaption>Laadperron · Distributiehal</figcaption>
    </figure>

    <section id="werkwijze" class="shell studio-work" aria-labelledby="workflow-title">
        <div>
            <p class="studio-label">Klantportaal</p>
            <h2 id="workflow-title">Van storing<br>tot herstel.</h2>
            <ol class="studio-steps">
                <li><span aria-hidden="true">01</span><div><h3>Meld de storing</h3><p>Kies de bedrijfsdeur en beschrijf wat er gebeurt.</p></div><x-dock-icon name="list" /></li>
                <li><span aria-hidden="true">02</span><div><h3>Bekijk je afspraak</h3><p>De werkplaats plant een datum en zet die bij de melding.</p></div><x-dock-icon name="calendar" /></li>
                <li><span aria-hidden="true">03</span><div><h3>Volg de afhandeling</h3><p>Lees in de tijdlijn wanneer de reparatie is afgerond.</p></div><x-dock-icon name="check" /></li>
            </ol>
        </div>
        <div class="glacier" aria-hidden="true">
            <div class="glacier-glow"></div>
            <div class="glacier-panes"><i></i><i></i><i></i><i></i><i></i><i></i><i></i></div>
        </div>
    </section>

    <section id="onderhoud" class="shell studio-maintenance" aria-labelledby="maintenance-title">
        <figure><img src="{{ asset('images/onderhoud.webp') }}" alt="Een monteur inspecteert de geleider van een industriële deur" loading="lazy" width="1100" height="734"><figcaption>Onderhoud · Geleider van een sectiedeur</figcaption></figure>
        <div>
            <h2 id="maintenance-title">Je deuren op één plek.</h2>
            <p>Bekijk per locatie welke deuren bij je bedrijf horen en welke storingen al gemeld zijn.</p>
            <a class="studio-link" href="{{ auth()->check() ? route('portal.index') : route('login') }}">Naar het portaal <x-dock-icon name="up-right" :size="17" /></a>
        </div>
    </section>
</x-layout>
