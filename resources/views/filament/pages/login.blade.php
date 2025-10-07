<x-filament-panels::page>
    <x-filament-panels::page.simple>
    <x-filament-panels::form wire:submit="login">
        {{ $this->form }}
        <x-filament-panels::form.actions>
            <x-filament::button type="submit" color="primary" class="w-full">
                Masuk
            </x-filament::button>
        </x-filament-panels::form.actions>
    </x-filament-panels::form>
</x-filament-panels::page.simple>

</x-filament-panels::page>
