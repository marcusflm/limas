<div>
    <x-header title="Itens Pedido {{$pedido->id}}" subtitle="Cliente: {{$pedido->cliente->nome}}" separator>
        @if($pedido->status_pedido_id == 1)
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar('/pedidos/' + {{$pedido->id}} + '/itens/create')" />
        </x-slot:actions>
        @endif
    </x-header>

    @if($itensPedido->count()>0)
    <x-card>
        <x-table :headers="$headers" :rows="$itensPedido">
            @scope('cell_valor_unitario', $item)
            {{ number_format($item->valor_unitario, 2, ',', '.') }}
            @endscope

            @scope('cell_valor_total', $item)
            {{ number_format($item->valor_total, 2, ',', '.') }}
            @endscope

            @scope('actions', $item)
            <x-button icon="o-trash" wire:click="delete({{ $item->id }})" class="text-red-500 btn-sm" />
            @endscope
        </x-table>
        <div class="grid gap-3">
            <div class="flex justify-end">
                <x-input label=Desconto wire:model="valor_desconto" thousands-separator="." fraction-separator="," />
            </div>
            <div class="flex justify-end">
                <x-input label="Frete" wire:model.live="valor_frete" thousands-separator="." fraction-separator="," readonly />
            </div>
            <div class="flex justify-end">
                <x-input label="Total do pedido" wire:model.live="valor_total" thousands-separator="." fraction-separator="," readonly />
            </div>
            <div class="flex justify-end gap-3">
                <x-button label="Voltar" @click="$wire.navegar('/pedidos')" />
                <x-button label="{{ $pedido->status_pedido_id == 1 ? 'Fechar pedido' : 'Pedido fechado' }}" icon="{{ $pedido->status_pedido_id == 1 ? 'o-lock-open' : 'o-lock-closed' }}" wire:click="alterar_status_pedido" class="btn + {{ $pedido->status_pedido_id == 1 ? 'btn-outline btn-primary' : 'bg-primary text-white'}}" />
            </div>
        </div>
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum item encontrado" />
    @endif
</div>