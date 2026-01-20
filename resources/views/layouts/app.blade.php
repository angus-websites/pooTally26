<x-layouts::app.header :title="$title ?? null">
        <x-container class="h-full mt-10 lg:mt-16">
            {{ $slot }}
        </x-container>
</x-layouts::app.header>
