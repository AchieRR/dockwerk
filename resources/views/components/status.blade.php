@props(['status'])
<span {{ $attributes->class(['status-chip', "status-{$status->value}"]) }}><span aria-hidden="true"></span>{{ $status->getLabel() }}</span>
