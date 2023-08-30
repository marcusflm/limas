<x-form wire:submit="save">
    <x-input label="Nome" wire:model="nome" required />
    <x-choices label="Categoria" wire:model="categoria_id" :options="$categorias" option-label="nome" icon="o-magnifying-glass" single searchable />
    <div class="w-1/2 lg:w-2/5 end-0">
        <x-input label="Valor" wire:model="valor" prefix="R$" thousands-separator="." fraction-separator="," money required />
    </div>
    <x-input label="Descrição" wire:model="descricao" />
    <x-slot:actions>
        <x-button label="Cancelar" wire:click="$dispatch('produto-edicao-concluida')" />
        <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>