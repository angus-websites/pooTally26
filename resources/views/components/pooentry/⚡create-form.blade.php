<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<div>
    <flux:modal.trigger name="edit-profile">
        <flux:button variant="primary">New Entry</flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-profile" class="md:w-96">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">New Poo Entry</flux:heading>
                <flux:text class="mt-2">Enter the details of your log</flux:text>
            </div>

            {{-- Date --}}
            <flux:date-picker with-today fixed-weeks max="today"/>

            {{-- Time --}}
            <flux:time-picker type="input" interval="30" max="now"/>

            {{-- Colour --}}
            <flux:select variant="listbox" placeholder="Select Colour" clearable>
                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.shield-check variant="mini" class="text-zinc-400"/>
                        Owner
                    </div>
                </flux:select.option>

                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.key variant="mini" class="text-zinc-400"/>
                        Administrator
                    </div>
                </flux:select.option>

                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.user variant="mini" class="text-zinc-400"/>
                        Member
                    </div>
                </flux:select.option>

                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.eye variant="mini" class="text-zinc-400"/>
                        Viewer
                    </div>
                </flux:select.option>
            </flux:select>

            {{-- Consistency --}}
            <flux:select variant="listbox" placeholder="Select Consistency" clearable>
                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.shield-check variant="mini" class="text-zinc-400"/>
                        Owner
                    </div>
                </flux:select.option>

                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.key variant="mini" class="text-zinc-400"/>
                        Administrator
                    </div>
                </flux:select.option>

                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.user variant="mini" class="text-zinc-400"/>
                        Member
                    </div>
                </flux:select.option>

                <flux:select.option>
                    <div class="flex items-center gap-2">
                        <flux:icon.eye variant="mini" class="text-zinc-400"/>
                        Viewer
                    </div>
                </flux:select.option>
            </flux:select>

            {{-- Add Note --}}
            <flux:field variant="inline">
                <flux:label>Add Note</flux:label>

                <flux:switch wire:model.live="notifications"/>

                <flux:error name="notifications"/>
            </flux:field>

            <div class="flex">
                <flux:spacer/>

                <flux:button type="submit" variant="primary">Save changes</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
