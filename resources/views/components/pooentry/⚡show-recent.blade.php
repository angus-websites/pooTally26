<?php

use App\Models\PooEntry;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component {


    public function with(){
        return [
            'entries' => Auth::user()->pooEntries()
            ->latest('occurred_at')
            ->limit(5)
            ->get()
        ];
    }

};
?>

<div class="space-y-2 p-6">
    <h3 class="text-sm font-semibold text-zinc-600 dark:text-zinc-400">
        Recent Logs
    </h3>

    @forelse ($entries as $entry)
        <div wire:key="{{ $entry->id }}"
             class="flex items-center justify-between rounded-lg border border-zinc-200 dark:border-zinc-700 p-3">
            <div class="flex flex-col">
                <span class="text-sm font-medium">
                    {{ $entry->consistency }} · {{ $entry->colour }}
                </span>

                <span class="text-xs text-zinc-500">
                    {{ $entry->occurred_at->format('M j, H:i') }}
                    Bruh
                </span>
            </div>

            @if ($entry->notes)
                <span class="text-zinc-400 text-sm">📝</span>
            @endif
        </div>
    @empty
        <p class="text-sm text-zinc-500">
            No logs yet.
        </p>
    @endforelse
</div>
