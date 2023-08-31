<x-form wire:submit="save">
    <x-choices label="Ingrediente" wire:model="ingrediente_id" :options="$ingredientes" option-label="nome" icon="o-magnifying-glass" placeholder="Selecione.." single searchable />
    <div class="lg:w-1/2">
        <x-input label="Valor unitário" wire:model="valor_unitario" prefix="R$" thousands-separator="." fraction-separator="," money />
    </div>
    <div class="mx-auto">
        <label for="quantidade" class="label mx-auto">
            <span class="label-text"><strong>Quantidade</strong></span>
        </label>
        <div class="items-center gap-x-3" id="quantidade" name="quantidade">
            <x-button wire:click="diminuir" icon="o-minus" class="btn-primary btn-md text-white" />
            <span wire:model="quantidade" class="btn no-animation btn-outline btn-primary px-5 py-1.5">{{ $quantidade }}</span>
            <x-button wire:click="aumentar" icon="o-plus" class="btn-primary btn-md text-white" />
        </div>
    </div>
    <x-slot:actions>
        <x-button label="Fechar" wire:click="$dispatch('compra-edicao-concluida')" />
        <x-button label="Adicionar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>