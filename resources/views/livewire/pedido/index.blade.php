<div>
    <x-header title="Pedidos" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar('/pedidos/create')" />
        </x-slot:actions>
    </x-header>

    @if($pedidos->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$pedidos" striped @row-click="$wire.navegar('/pedidos/' + $event.detail.id + '/itens')">
            @scope('cell_data_pedido', $pedido)
            {{ $pedido->data_pedido->format('d/m/Y') }}
            @endscope

            @scope('cell_valor_itens', $pedido)
            {{ number_format($pedido->valor_itens, 2, ',', '.') }}
            @endscope

            @scope('cell_valor_frete', $pedido)
            {{ number_format($pedido->valor_frete, 2, ',', '.') }}
            @endscope

            @scope('cell_valor_desconto', $pedido)
            {{ number_format($pedido->valor_desconto, 2, ',', '.') }}
            @endscope

            @scope('cell_valor_total', $pedido)
            {{ number_format($pedido->valor_total, 2, ',', '.') }}
            @endscope

            @scope('actions', $pedido)
            <div class="flex">
                <x-button icon="o-currency-dollar" wire:click="altera_status_pagamento({{ $pedido->id }})" class="btn + {{ $pedido->status_pagamento->id == 1 ? 'btn-outline btn-error' : 'bg-success text-white'}}" />
            </div>
            @endscope

        </x-table>
    </x-card>
    @else
    <x-alert icon="o-user" title="Não foram encontrados pedidos" />
    @endif
</div>