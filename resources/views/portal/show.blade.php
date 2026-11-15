<x-layout :title="$serviceRequest->reference">
    <div class="shell portal-shell detail-shell">
        <a href="{{ route('portal.index') }}" class="back-link"><x-dock-icon name="back" :size="18" /> Terug naar overzicht</a>
        @if (session('notice'))
            <p class="notice" role="status"><x-dock-icon name="check" :size="18" /> {{ session('notice') }}</p>
        @endif
        <header class="detail-heading">
            <div><p class="eyebrow section-kicker">{{ $serviceRequest->reference }}</p><h1>{{ $serviceRequest->title }}</h1><p class="muted">{{ $serviceRequest->door->name }} · {{ $serviceRequest->door->location }}</p></div>
            <x-status :status="$serviceRequest->status" />
        </header>
        <div class="portal-grid">
            <section class="panel detail-panel" aria-labelledby="detail-title">
                <h2 id="detail-title">Over de melding</h2>
                <p class="report-description">{{ $serviceRequest->description }}</p>
                <div class="appointment"><x-dock-icon name="calendar" :size="23" /><div><strong>Afspraak</strong>
                    @if ($serviceRequest->scheduled_for)
                        <p><time datetime="{{ $serviceRequest->scheduled_for->toDateString() }}">{{ $serviceRequest->scheduled_for->locale('nl')->translatedFormat('l j F Y') }}</time></p>
                    @else
                        <p>Er is nog geen datum gepland.</p>
                    @endif
                </div></div>
            </section>
            <section class="panel detail-panel" aria-labelledby="timeline-title">
                <h2 id="timeline-title">Tijdlijn</h2>
                <ol class="timeline">
                    @foreach ($serviceRequest->updates as $update)
                        <li><span class="timeline-dot"></span><div><strong>{{ $update->status->getLabel() }}</strong><time datetime="{{ $update->created_at->toIso8601String() }}">{{ $update->created_at->format('d-m-Y · H:i') }}</time>@if ($update->note)<p>{{ $update->note }}</p>@endif</div></li>
                    @endforeach
                </ol>
            </section>
        </div>
    </div>
</x-layout>
