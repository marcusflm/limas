<div>
    <x-header title="Novo item" subtitle="Pedido {{ $pedido->id }} - Cliente: {{ $pedido->cliente->nome }}" separator />
    <div class="w-1/2 mx-auto">
        <x-card shadow>
            <x-form wire:submit="save">
                <x-select label="Produto" wire:model="produto_id" placeholder="Selecione.." :options="$produtos" option-value="id" option-label="nome" />
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
                    <x-button label="Cancelar" @click="$wire.navegar('/pedidos/' + {{$pedido->id}} + '/itens')" />
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>