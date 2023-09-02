<div>
    <x-form wire:submit="save">
        <x-choices label="Cliente" wire:model="cliente_id" :options="$clientes" option-label="nome" icon="o-magnifying-glass" single searchable />
        <label for="data_pedido" class="pb-0 label label-text font-semibold">Data pedido</label>
        <input type="date" wire:model="data_pedido" class="input input-primary w-full peer" />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="$dispatch('pedido-edicao-concluida')" />
            <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>