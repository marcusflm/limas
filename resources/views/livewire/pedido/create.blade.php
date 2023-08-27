<div>
    <x-form wire:submit="save">
        <x-choices label="Cliente" wire:model="cliente_id" :options="$clientes" option-label="nome" icon="o-magnifying-glass" placeholder="Selecione.." single searchable />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="$parent.myModal = false" />
            <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>