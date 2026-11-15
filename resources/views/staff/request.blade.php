<div style="display: grid; gap: 1rem; font-size: .875rem">
    <p class="font-medium">{{ $report->reference }} · {{ $report->door->company->name }} · {{ $report->door->name }}</p>
    <p style="white-space: pre-wrap; overflow-wrap: anywhere">{{ $report->description }}</p>
    @if ($report->scheduled_for)
        <p>Afspraak op {{ $report->scheduled_for->format('d-m-Y') }}.</p>
    @endif
    <ol style="display: grid; gap: .5rem; border-top: 1px solid #d5dce4; padding-top: 1rem" aria-label="Statusgeschiedenis">
        @foreach ($updates as $update)
            <li><strong>{{ $update->status->getLabel() }}</strong> · {{ $update->created_at->format('d-m-Y H:i') }}
                @if ($update->note)
                    <p>{{ $update->note }}</p>
                @endif
            </li>
        @endforeach
    </ol>
</div>
