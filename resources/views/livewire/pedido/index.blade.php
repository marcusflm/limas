<div>
    <x-header title="Pedidos" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Novo pedido">
        <livewire:pedido.pedido-create />
    </x-modal>

    @if($pedidos->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$pedidos" striped @row-click="$wire.navegar('/pedidos/' + $event.detail.id)">
            @scope('cell_data_pedido', $pedido)
            {{ $pedido->data_pedido->format('d/m/Y') }}
            @endscope

            @scope('cell_valor_total', $pedido)
            {{ number_format($pedido->valor_total, 2, ',', '.') }}
            @endscope

            @scope('actions', $pedido)
            <div class="flex gap-3">
                @if($pedido->status_pedido_id == 2)
                <x-button icon="o-currency-dollar" wire:click="altera_status_pagamento({{ $pedido->id }})" class="btn btn-sm + {{ $pedido->status_pagamento->id == 1 ? 'btn-outline btn-error' : 'bg-success text-white'}}" />
                @endif
                @if($pedido->status_pedido_id == 1)
                <x-button icon="o-trash" wire:click="delete({{ $pedido->id }})" class="btn-sm btn-outline btn-error" />
                @endif
            </div>
            @endscope
        </x-table>
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-user" title="Não foram encontrados pedidos" />
    </x-card>
    @endif
</div>