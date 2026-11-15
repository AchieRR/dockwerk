<x-layout title="Mijn portaal">
    <div class="shell portal-shell">
        <div class="portal-hero">
            <div><p class="eyebrow hero-kicker"><span></span> Klantportaal</p><h1>{{ $company->name }}</h1><p>Bekijk je bedrijfsdeuren en volg je servicemeldingen.</p></div>
            @if ($doors->isNotEmpty())
                <a class="button button-ice" href="{{ route('portal.create') }}"><x-dock-icon name="plus" :size="20" /> Nieuwe melding</a>
            @endif
        </div>
        <div class="portal-grid">
            <section class="panel" aria-labelledby="requests-title">
                <div class="panel-heading"><div><h2 id="requests-title">Meldingen</h2><p>Open een melding voor de afspraak en tijdlijn.</p></div><span class="count-chip" aria-label="{{ $requests->total() }} meldingen">{{ $requests->total() }}</span></div>
                @if ($requests->isEmpty())
                    <div class="empty-state"><x-dock-icon name="list" :size="28" /><h3>Nog geen meldingen</h3><p>Wanneer je een storing meldt, verschijnt die hier.</p></div>
                @else
                    <ul class="request-list">
                        @foreach ($requests as $report)
                            <li><a class="request-row" href="{{ route('portal.show', $report) }}">
                                <span class="request-icon"><x-dock-icon name="door" :size="20" /></span>
                                <span class="request-summary"><strong>{{ $report->title }}</strong><small>{{ $report->reference }} · {{ $report->door->name }}</small></span>
                                <x-status :status="$report->status" />
                                <x-dock-icon name="arrow" :size="17" class="row-arrow" />
                            </a></li>
                        @endforeach
                    </ul>
                    @if ($requests->hasPages())
                        <nav class="pagination" aria-label="Meldingenpagina’s">
                            @if ($requests->previousPageUrl()) <a href="{{ $requests->previousPageUrl() }}">Vorige</a> @endif
                            <span>Pagina {{ $requests->currentPage() }} van {{ $requests->lastPage() }}</span>
                            @if ($requests->nextPageUrl()) <a href="{{ $requests->nextPageUrl() }}">Volgende</a> @endif
                        </nav>
                    @endif
                @endif
            </section>
            <section class="panel doors-panel" aria-labelledby="doors-title">
                <div class="panel-heading"><div><h2 id="doors-title">Bedrijfsdeuren</h2><p>Geregistreerd voor jouw bedrijf.</p></div></div>
                <ul class="door-list">
                    @forelse ($doors as $door)
                        <li><span class="request-icon"><x-dock-icon name="door" :size="19" /></span><span><strong>{{ $door->name }}</strong><small>{{ $door->location }} · {{ $door->code }}</small></span></li>
                    @empty
                        <li>Er zijn nog geen deuren geregistreerd.</li>
                    @endforelse
                </ul>
            </section>
        </div>
    </div>
</x-layout>
