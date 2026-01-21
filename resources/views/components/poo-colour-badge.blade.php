@props([
    'colour', // PooColour enum instance
])


@if($colour)
<div class="flex items-center gap-2">
    <span

        class="h-3 w-3 rounded-full
        @switch($colour->value)
            @case('brown') bg-brown-500 dark:bg-brown-400 @break
            @case('green') bg-green-700 dark:bg-green-700 @break
            @case('yellow') bg-yellow-400 @break
            @case('black') bg-black @break
            @case('red') bg-red-500 @break
        @endswitch
    "

    ></span>
    {{ ucfirst($colour->value) }}
</div>
@endif
