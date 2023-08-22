<div>
    <x-header title="Novo pedido" separator />
    <div class="w-1/2 mx-auto">
        <x-card shadow>
            <x-form wire:submit="save">
                <x-select label="Cliente" placeholder="Selecione.." :options="$clientes" option-value="id" option-label="nome" wire:model="cliente_id" />
                <x-slot:actions>
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>