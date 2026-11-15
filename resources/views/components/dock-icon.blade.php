@props(['name', 'size' => 20])
@php($paths = [
    'arrow' => 'M5 12h14m-7-7 7 7-7 7',
    'up-right' => 'M7 17 17 7M7 7h10v10',
    'plus' => 'M12 5v14M5 12h14',
    'back' => 'M19 12H5m7 7-7-7 7-7',
    'door' => 'M3 21h18M5 21V6l7-3 7 3v15M8 21V9h8v12M8 13h8m-8 4h8',
    'calendar' => 'M7 3v4m10-4v4M4 10h16M6 5h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z',
    'check' => 'm5 12 4 4L19 6',
    'list' => 'M8 6h12M8 12h12M8 18h12M4 6h.01M4 12h.01M4 18h.01',
    'clock' => 'M12 7v5l3 2m6-2a9 9 0 1 1-18 0 9 9 0 0 1 18 0z',
    'logout' => 'M10 17l5-5-5-5m5 5H3m10-8h5a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-5',
    'shield' => 'M12 22s7-3.5 7-10V5l-7-3-7 3v7c0 6.5 7 10 7 10zm-3-10 2 2 4-4',
    'alert' => 'M12 8v5m0 3h.01M10 4.5 3 18a1.4 1.4 0 0 0 1.3 2h15.4a1.4 1.4 0 0 0 1.3-2L14 4.5a2.3 2.3 0 0 0-4 0z',
])
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" {{ $attributes }}><path d="{{ $paths[$name] }}"/></svg>
