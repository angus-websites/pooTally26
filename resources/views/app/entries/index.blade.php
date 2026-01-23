<x-layouts::app :title="__('My Poos')">
    <x-page-title :heading="__('My Poos')" subtitle="Manage your Poos here">
        <livewire:pooentry.create-form/>
    </x-page-title>

    <div>
        <livewire:pooentry.show-all/>
    </div>
</x-layouts::app>
