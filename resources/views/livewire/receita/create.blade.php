<x-form wire:submit="save">
    <x-choices label="Produto" wire:model="produto_id" :options="$produtos" option-label="nome" icon="o-magnifying-glass" single searchable />
    <x-slot:actions>
        <x-button label="Cancelar" wire:click="$parent.myModal = false" />
        <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>