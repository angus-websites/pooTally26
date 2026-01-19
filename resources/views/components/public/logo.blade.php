@props([
    'mode' => 'auto', // auto | light | dark
])
<div class="text-center">
    @if ($mode === 'light')
        <img {{ $attributes->class('h-10 mx-auto') }}
             src="{{ asset('assets/images/logo/logo.png') }}" alt="PooTally Logo">
    @elseif ($mode === 'dark')
        <img {{ $attributes->class('h-10 mx-auto') }}
             src="{{ asset('assets/images/logo/logo-light.png') }}" alt="PooTally Logo">
    @else
        {{-- auto (Tailwind dark mode) --}}
        <img {{ $attributes->class('dark:hidden h-10 mx-auto') }}
             src="{{ asset('assets/images/logo/logo.png') }}" alt="PooTally Logo">

        <img {{ $attributes->class('hidden dark:block h-10 mx-auto') }}
             src="{{ asset('assets/images/logo/logo-light.png') }}" alt="PooTally Logo">
    @endif
</div>
