<?php

use App\Enum\PooColour;
use App\Enum\PooConsistency;
use App\Services\PooEntryService;
use Flux\Flux;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Carbon;

new class extends Component {

    // Custom date/time fields
    public ?string $date;
    public ?string $time;

    // Virtual field for validation
    public ?string $datetime = null;
    public bool $useCustomDatetime = false;

    public ?string $colour = null;
    public ?string $consistency = null;

    public ?string $notes = null;

    protected function rules(): array
    {
        return [
            'colour' => [
                Rule::in(array_column(PooColour::cases(), 'value')),
            ],

            'consistency' => [
                Rule::in(array_column(PooConsistency::cases(), 'value')),
            ],

            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],

            // Virtual field
            'datetime' => [
                function ($attribute, $value, $fail) {

                    // Only validate if using custom date/time
                    if (!$this->useCustomDatetime) {
                        return;
                    }

                    if (!$this->date) {
                        $fail('Please select a date');
                        return;
                    }

                    if (!$this->time) {
                        $fail('Please select a time');
                        return;
                    }

                    try {
                        $datetime = Carbon::createFromFormat(
                            'Y-m-d H:i',
                            "{$this->date} {$this->time}",
                            config('app.timezone')
                        );
                    } catch (\Exception) {
                        $fail('The selected date and time are invalid.');
                        return;
                    }

                    if ($datetime->isFuture()) {
                        $fail('The selected date and time cannot be in the future.');
                    }
                },
            ],
        ];
    }


    public function mount(): void
    {
        $now = Carbon::now();

        // Defaults for fast entry
        $this->date = $now->toDateString();
        $this->time = $now->format('H:i');

        $this->colour = PooColour::BROWN->value;
        $this->consistency = PooConsistency::NORMAL->value;
    }

    /**
     * Get available colours
     * @return array<PooColour>
     */
    public function getColoursProperty(): array
    {
        return PooColour::cases();
    }

    /**
     * Get available consistencies
     * @return array<PooConsistency>
     */
    public function getConsistenciesProperty(): array
    {
        return PooConsistency::cases();
    }


    public function save(PooEntryService $pooEntryService): void
    {
        // Validate input
        $data = $this->validate();

        // Create entry
        $pooEntryService->create([
            'colour' => $data['colour'],
            'consistency' => $data['consistency'],
            'occurred_at' => $this->useCustomDatetime
                ? Carbon::createFromFormat(
                    'Y-m-d H:i',
                    "{$this->date} {$this->time}",
                    config('app.timezone')
                )
                : Carbon::now(),
            'notes' => $this->notes
        ]);

        Flux::toast(
            text: "Your poo has been logged!",
            variant: 'success',
        );

        // Dispatch event to allow other components to update
        $this->dispatch('poo-entry:saved');

        // Close modal
        Flux::modal('new-poo-entry')->close();
    }

};
?>

<div>

    @if (session()->has('info'))
        <flux:callout color="teal" class="mb-4" icon="information-circle"
                      :heading="session('info')"/>
    @endif

    <flux:modal.trigger name="new-poo-entry">
        <flux:button variant="primary">New Poo</flux:button>
    </flux:modal.trigger>

    <flux:modal name="new-poo-entry" class="w-full sm:w-96" flyout variant="floating">
        <form wire:submit.prevent="save" class="space-y-6" x-data="{ showNotes: false, showDatetime: false }">
            <div>
                <flux:heading size="lg">New Poo Entry</flux:heading>
                <flux:text class="mt-2">Quickly log your entry</flux:text>
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
                            <x-poo-colour-badge :colour="$colour"/>
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

            {{-- Date (compact toggle) --}}
            <flux:field variant="inline">
                <flux:label>Modify Date / Time</flux:label>
                <flux:switch x-model="showDatetime" @change="$wire.useCustomDatetime = showDatetime"/>
            </flux:field>

            {{-- Date & Time --}}
            <div x-show="showDatetime" x-transition class="grid grid-cols-2 gap-4">
                <flux:field>
                    <flux:label>Date</flux:label>
                    <flux:date-picker
                        wire:model="date"
                        with-today
                        fixed-weeks
                        max="today"
                    />
                </flux:field>

                <flux:field>
                    <flux:label>Time</flux:label>
                    <flux:time-picker
                        wire:model="time"
                        type="input"
                        interval="30"
                        max="now"
                    />
                </flux:field>

                <div class="md:col-span-full">
                    <flux:error name="datetime"/>
                </div>
            </div>

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

