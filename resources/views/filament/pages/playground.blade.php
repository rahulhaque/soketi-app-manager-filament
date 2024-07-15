<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            Test Event Broadcasting
        </x-slot>

        <x-filament-panels::form wire:submit="send">
            {{ $this->form }}

            <x-filament::button type="submit" icon="heroicon-o-paper-airplane">
                Send Event
            </x-filament::button>
        </x-filament-panels::form>
    </x-filament::section>
</x-filament-panels::page>