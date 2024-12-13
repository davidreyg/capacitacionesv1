<x-filament-panels::page>
    <x-filament-panels::form id="form" wire:key="indicadorestablecimiento.form" wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getActions()" />
    </x-filament-panels::form>

    @script
        <script>
            Livewire.on('submitForm', function(url) {
                window.open(url, '_blank');
            });
        </script>
    @endscript
</x-filament-panels::page>
