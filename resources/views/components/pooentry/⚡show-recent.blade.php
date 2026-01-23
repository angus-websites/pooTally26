<?php

use App\Services\PooEntryService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public Collection $entries;

    public function mount(PooEntryService $service): void
    {
        $this->refreshEntries($service);
    }

    #[On('poo-entry:refresh')]
    public function refreshEntries(PooEntryService $service): void
    {
        $this->entries = $service->latestForUser(Auth::user());
    }


};
?>

<div class="space-y-2">
    <h3 class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">
        Recent Poos
    </h3>

    @forelse ($entries as $entry)
        <flux:card wire:key="{{ $entry->id }}" size="sm">
            <flux:heading class="flex items-center gap-2">
                {{ $entry->occurred_at->format('M j, H:i') }}
            </flux:heading>
            <div class="mt-2 flex flex-row gap-x-4">
                <x-poo-colour-badge :colour="$entry->colour"/>
                <x-poo-consistency-badge :consistency="$entry->consistency"/>
            </div>
            @if($entry->notes)
                <div class="mt-3 border-t pt-2 dark:border-t-zinc-600">
                    <flux:text>
                        <span>Notes:</span> <span class="ml-1">{{$entry->notes}}</span>
                    </flux:text>
                </div>
            @endif
        </flux:card>
    @empty

        <div class="text-center mt-8">
            <p class="mt-2 text-sm font-semibold text-gray-900 dark:text-white">No Poos found</p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by logging a new poo.</p>
        </div>

    @endforelse
</div>
