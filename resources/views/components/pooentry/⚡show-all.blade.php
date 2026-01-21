<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;

new class extends Component {

    use WithPagination, WithoutUrlPagination;

    #[On('poo-entry:refresh')]
    #[Computed]
    public function entries()
    {
        return Auth::user()->pooEntries()
            ->latest('occurred_at')
            ->paginate(20);
    }

};
?>

<div class="space-y-2">
    @forelse ($this->entries as $entry)
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
        </div>

    @endforelse

    @if($this->entries->hasPages())
        <div class="mt-4">
            {{ $this->entries->links() }}
        </div>
    @endif
</div>
