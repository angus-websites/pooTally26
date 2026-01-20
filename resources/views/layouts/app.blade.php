<x-layouts::app.header :title="$title ?? null">
    <flux:main class="mx-auto max-w-7xl w-full">
        {{ $slot }}
    </flux:main>
</x-layouts::app.header>
