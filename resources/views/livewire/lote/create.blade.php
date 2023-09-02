<x-form wire:submit="save">
    <x-choices label="Produto" wire:model="produto_id" :options="$produtos" option-label="nome" icon="o-magnifying-glass" single searchable />
    <x-choices label="Compra" wire:model="compra_id" :options="$compras" option-label="id" icon="o-magnifying-glass" single searchable />
    <div class="lg:w-1/2">
        <x-input label="Quantidade" wire:model="quantidade" thousands-separator="." fraction-separator="," />
    </div>

    <x-slot:actions>
        <x-button label="Cancelar" wire:click="$parent.myModal = false" />
        <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>