<?php

use App\Services\PooEntryService;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;

new class extends Component {

    use WithPagination, WithoutUrlPagination;

    public ?int $deletingEntryId = null;

    #[On('poo-entry:refresh')]
    #[Computed]
    public function entries()
    {
        return app(PooEntryService::class)->paginatePoos();
    }

    public function confirmDelete(int $entryId): void
    {
        // Set the entry ID to be deleted
        $this->deletingEntryId = $entryId;
    }

    public function deletePoo(PooEntryService $service): void
    {

        $entry = $service->find($this->deletingEntryId);

        if (!$entry)
        {
            Flux::toast('Poo entry not found.', 'danger');
            return;
        }

        try{
            $service->delete($entry);

        } catch (Exception)
        {
            Flux::toast('An error occurred while deleting the poo entry.', 'danger');
            return;
        }

        // Reset deleting entry ID
        $this->deletingEntryId = null;

        // Refresh other components
        $this->dispatch('poo-entry:refresh');

        // Close modal
        Flux::modal('delete-poo')->close();
    }

};
?>

<div class="space-y-2">
    @forelse ($this->entries as $entry)
        <flux:card wire:key="{{ $entry->id }}" size="sm">

            <div class="flex flex-row justify-between items-center">
                <div>
                    <flux:heading class="flex items-center gap-2">
                        {{ $entry->occurred_at->format('M j, H:i') }}
                    </flux:heading>
                    <div class="mt-2 flex flex-row gap-x-4">
                        <x-poo-colour-badge :colour="$entry->colour"/>
                        <x-poo-consistency-badge :consistency="$entry->consistency"/>
                    </div>
                </div>
                <div>

                    <flux:modal.trigger name="delete-poo" wire:click="confirmDelete({{ $entry->id }})">
                        <flux:tooltip content="Delete">
                            <flux:button variant="danger" icon="trash" />
                        </flux:tooltip>
                    </flux:modal.trigger>

                </div>
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
            <p class="mt-2 text-sm font-semibold text-zinc-900 dark:text-white">No Poos found</p>
        </div>

    @endforelse

    @if($this->entries->hasPages())
        <div class="mt-4">
            {{ $this->entries->links() }}
        </div>
    @endif

    <flux:modal name="delete-poo" class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Delete Poo?</flux:heading>

                    <flux:text class="mt-2">
                        You're about to delete this Poo.<br>
                        This action cannot be reversed.
                    </flux:text>
                </div>

                <div class="flex gap-2">
                    <flux:spacer/>

                    <flux:modal.close>
                        <flux:button variant="ghost">Cancel</flux:button>
                    </flux:modal.close>

                    <flux:button
                                variant="danger"
                                 :disabled="!$deletingEntryId"
                                 wire:click="deletePoo"
                    >
                        Delete poo
                    </flux:button>
                </div>
            </div>
        </flux:modal>

</div>
