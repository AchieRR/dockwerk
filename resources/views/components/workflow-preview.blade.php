@php
    use App\Enums\RequestStatus;

    $steps = [
        [
            'status' => RequestStatus::Reported,
            'icon' => 'list',
            'title' => 'Over de melding',
            'note' => 'De deur stopt halverwege en gaat daarna automatisch weer omhoog.',
        ],
        [
            'status' => RequestStatus::Scheduled,
            'icon' => 'calendar',
            'title' => 'Afspraak op 20 november',
            'note' => 'De werkplaats komt langs bij het laadperron in Sneek.',
        ],
        [
            'status' => RequestStatus::Completed,
            'icon' => 'check',
            'title' => 'Terugkoppeling van de werkplaats',
            'note' => 'De eindschakelaar is opnieuw afgesteld. De deur sluit weer volledig.',
        ],
    ];
@endphp

<fieldset class="workflow-preview">
    <legend class="sr-only">Status van de voorbeeldmelding</legend>

    <div class="preview-controls">
        @foreach ($steps as $step)
            <label class="preview-choice">
                <input class="sr-only" type="radio" name="preview-status" value="{{ $step['status']->value }}"
                    aria-controls="preview-{{ $step['status']->value }}" @checked($loop->first)>
                <x-dock-icon :name="$step['icon']" :size="17" />
                {{ $step['status']->getLabel() }}
            </label>
        @endforeach
    </div>

    <div class="preview-ticket">
        <header class="preview-ticket-title">
            <p>Voorbeeldmelding <span>DW-0001</span></p>
            <h3>Laadpoort 3 sluit niet</h3>
            <p>Noordkade Logistiek · Sneek</p>
        </header>
        <div class="preview-stages">
            @foreach ($steps as $step)
                <div class="preview-stage" id="preview-{{ $step['status']->value }}">
                    <x-status :status="$step['status']" />
                    <h4>{{ $step['title'] }}</h4>
                    <p>{{ $step['note'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</fieldset>
