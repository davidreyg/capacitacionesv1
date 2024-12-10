<x-filament-panels::page>
    <x-filament-panels::form id="form" wire:key="indicador.form" wire:submit="save">
        {{ $this->form }}

        <x-filament-panels::form.actions :actions="$this->getActions()" />
    </x-filament-panels::form>


</x-filament-panels::page>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('submitForm', function(url) {
            window.open(url, '_blank');
        });
    })
</script>
