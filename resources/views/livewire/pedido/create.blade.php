<div>
    <x-header title="Novo pedido" separator />
    <div class="mx-auto lg:w-1/2 md:w-3/5">
        <x-card shadow>
            <x-form wire:submit="save">
                <x-select label="Cliente" placeholder="Selecione.." :options="$clientes" option-value="id" option-label="nome" wire:model="cliente_id" />
                <x-slot:actions>
                    <x-button label="Cancelar" @click="$wire.navegar('/pedidos')" />
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>