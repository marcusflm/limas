<x-form wire:submit="save">
    <x-input label="Nome" wire:model="nome" />
    <div class="lg:w-1/2">
        <x-input label="Valor Frete" wire:model="frete" prefix="R$" thousands-separator="." fraction-separator="," money />
    </div>
    <x-slot:actions>
        <x-button label="Cancelar" wire:click="$dispatch('bairro-edicao-concluida')" />
        <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>