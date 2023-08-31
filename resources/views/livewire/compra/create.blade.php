<div>
    <x-form wire:submit="save">
        <x-choices label="Mercado" wire:model="mercado_id" :options="$mercados" option-label="nome" icon="o-magnifying-glass" single searchable />
        <label for="data_compra" class="pb-0 label label-text font-semibold">Data compra</label>
        <input id="data_compra" wire:model="data_compra" type="date" class="input input-primary w-full peer" />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="$parent.myModal = false" />
            <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>