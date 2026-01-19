<img
    {{ $attributes->class([
        'dark:hidden',
        'h-8',
        'w-auto',
        'max-w-full',
        'object-contain'
    ]) }}
    src="{{ asset('assets/images/logo/logo.png') }}"
    alt="PooTally Logo"
/>

<img
    {{ $attributes->class([
        'hidden dark:block',
        'h-8',
        'w-auto',
        'max-w-full',
        'object-contain'
    ]) }}
    src="{{ asset('assets/images/logo/logo-light.png') }}"
    alt="PooTally Logo"
/>

