<?php

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {

    public Collection $entries;

    public function mount(): void
    {
        $this->refreshEntries();
    }

    #[On('poo-entry:refresh')]
    public function refreshEntries(): void
    {
        $this->entries = Auth::user()->pooEntries()
            ->latest('occurred_at')
            ->limit(5)
            ->get();
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
                <flux:badge size="sm">{{ $entry->consistency }}</flux:badge>
            </div>
        </flux:card>
    @empty
        <p class="text-sm text-zinc-500">
            No logs yet.
        </p>
    @endforelse
</div>
