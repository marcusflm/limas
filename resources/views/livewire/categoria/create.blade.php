<x-form wire:submit="save">
    <x-input label="Nome" wire:model="nome" required />
    <x-slot:actions>
        <x-button label="Cancelar" wire:click="$dispatch('categoria-edicao-concluida')" />
        <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>