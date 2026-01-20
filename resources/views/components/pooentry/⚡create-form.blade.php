<?php

use App\Enum\PooColour;
use App\Enum\PooConsistency;
use Livewire\Component;
use Illuminate\Support\Carbon;

new class extends Component {
    public string $date;
    public string $time;

    public ?string $colour = null;
    public ?string $consistency = null;

    public ?string $notes = null;
    
    public function mount(): void
    {
        $now = Carbon::now();

        // Defaults for fast entry
        $this->date = $now->toDateString();
        $this->time = $now->format('H:i');

        $this->colour = PooColour::BROWN->value;
        $this->consistency = PooConsistency::NORMAL->value;
    }

    public function getColoursProperty(): array
    {
        return PooColour::cases();
    }

    public function getConsistenciesProperty(): array
    {
        return PooConsistency::cases();
    }

    public function save(): void
    {
        // validation + persistence later
    }

};
?>

<div>
    <flux:modal.trigger name="new-poo-entry">
        <flux:button variant="primary">New Entry</flux:button>
    </flux:modal.trigger>

    <flux:modal name="new-poo-entry" class="md:w-2xl">
        <form wire:submit.prevent="save" class="space-y-6" x-data="{ showNotes: false }">
            <div>
                <flux:heading size="lg">New Poo Entry</flux:heading>
                <flux:text class="mt-2">Quickly log your entry</flux:text>
            </div>

            {{-- Date & Time --}}
            <div class="md:grid md:grid-cols-2 md:gap-4 space-y-6 md:space-y-0">
                <flux:field>
                    <flux:label>Date</flux:label>
                    <flux:date-picker
                        wire:model="date"
                        with-today
                        fixed-weeks
                        max="today"
                    />
                    <flux:error name="date"/>
                </flux:field>

                <flux:field>
                    <flux:label>Time</flux:label>
                    <flux:time-picker
                        wire:model="time"
                        type="input"
                        interval="30"
                        max="now"
                    />
                    <flux:error name="time"/>
                </flux:field>
            </div>

            {{-- Colour --}}
            <flux:field>
                <flux:label>Colour</flux:label>
                <flux:select
                    wire:model="colour"
                    variant="listbox"
                >
                    @foreach ($this->colours as $colour)
                        <flux:select.option value="{{ $colour->value }}">
                            <div class="flex items-center gap-2">
                                <span
                                    class="h-3 w-3 rounded-full
                                        @switch($colour->value)
                                            @case('brown') bg-brown-500 dark:bg-brown-400 @break
                                            @case('green') bg-green-700 dark:bg-green-700 @break
                                            @case('yellow') bg-yellow-400 @break
                                            @case('black') bg-black @break
                                            @case('red') bg-red-500 @break
                                        @endswitch
                                    "
                                ></span>
                                {{ ucfirst($colour->value) }}
                            </div>
                        </flux:select.option>

                    @endforeach
                </flux:select>
                <flux:error name="colour"/>
            </flux:field>

            {{-- Consistency --}}
            <flux:field>
                <flux:label>Consistency</flux:label>
                <flux:select
                    wire:model="consistency"
                    variant="listbox"
                >
                    @foreach ($this->consistencies as $consistency)
                        <flux:select.option value="{{ $consistency->value }}">
                            <div class="flex items-center gap-2">
                                {{ ucfirst($consistency->value) }}
                            </div>
                        </flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="consistency"/>
            </flux:field>

            {{-- Notes (compact toggle) --}}
            <flux:field variant="inline">
                <flux:label>Add Note</flux:label>
                <flux:switch x-model="showNotes"/>
            </flux:field>

            <flux:field x-show="showNotes" x-transition>
                <flux:textarea
                    wire:model.defer="notes"
                    placeholder="Optional notes…"
                    rows="3"
                />
            </flux:field>

            <div class="flex">
                <flux:spacer/>
                <flux:button type="submit" variant="primary">
                    Log
                </flux:button>
            </div>
        </form>
    </flux:modal>
</div>

