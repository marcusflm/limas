<x-form wire:submit="save">
    <x-choices label="Ingrediente" wire:model="ingrediente_id" :options="$ingredientes" option-label="nome" icon="o-magnifying-glass" placeholder="Selecione.." single searchable />
    <div class="lg:w-1/2">
        <x-input label="Quantidade" wire:model="quantidade" thousands-separator="." fraction-separator="," />
    </div>

    <x-slot:actions>
        <x-button label="Fechar" wire:click="$dispatch('receita-edicao-concluida')" />
        <x-button label="Adicionar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>