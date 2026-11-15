<x-layout title="Storing melden">
    <div class="shell narrow-shell">
        <a href="{{ route('portal.index') }}" class="back-link"><x-dock-icon name="back" :size="18" /> Terug naar overzicht</a>
        <section class="panel form-panel" aria-labelledby="report-title">
            <p class="eyebrow section-kicker">Nieuwe melding</p><h1 id="report-title">Storing melden.</h1>
            <p class="muted">Kies de bedrijfsdeur en vertel wat er aan de hand is.</p>
            @if ($doors->isEmpty())
                <p class="notice">Je bedrijf heeft nog geen geregistreerde deuren.</p>
            @else
                <form method="POST" action="{{ route('portal.store') }}" class="stacked-form">
                    @csrf
                    <label for="door_id">Bedrijfsdeur</label>
                    <select name="door_id" id="door_id" required @error('door_id') aria-invalid="true" aria-describedby="door_id-error" @enderror>
                        <option value="">Kies een deur</option>
                        @foreach ($doors as $door)
                            <option value="{{ $door->id }}" @selected(old('door_id') == $door->id)>{{ $door->name }} · {{ $door->location }}</option>
                        @endforeach
                    </select>
                    <x-field-error field="door_id" />
                    <label for="title">Onderwerp</label>
                    <input id="title" name="title" type="text" required maxlength="100" value="{{ old('title') }}" placeholder="Bijv. Laadpoort 3 sluit niet" @error('title') aria-invalid="true" aria-describedby="title-error" @enderror>
                    <x-field-error field="title" />
                    <label for="description">Wat gebeurt er?</label>
                    <textarea id="description" name="description" required minlength="10" maxlength="2000" rows="5" placeholder="Beschrijf de storing en wanneer die optreedt." @error('description') aria-invalid="true" aria-describedby="description-error" @enderror>{{ old('description') }}</textarea>
                    <x-field-error field="description" />
                    <button class="button button-dark" type="submit">Melding versturen <x-dock-icon name="arrow" :size="18" /></button>
                </form>
            @endif
        </section>
    </div>
</x-layout>
