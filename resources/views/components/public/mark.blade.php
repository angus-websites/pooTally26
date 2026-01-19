<div class="text-center">
    {{-- auto (Tailwind dark mode) --}}
    <img {{ $attributes->class('dark:hidden mx-auto') }}
         src="{{ asset('assets/images/logo/mark.png') }}" alt="PooTally Logo">

    <img {{ $attributes->class('hidden dark:block mx-auto') }}
         src="{{ asset('assets/images/logo/mark-light.png') }}" alt="PooTally Logo">
</div>
