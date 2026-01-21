@props([
    'consistency',
])


@if($consistency)
    <flux:badge size="sm">{{ $consistency }}</flux:badge>
@endif
