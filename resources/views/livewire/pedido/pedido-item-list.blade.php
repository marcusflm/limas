<div>
    <x-modal wire:model="myModal" title="Edita item">
        @if($item)
        <livewire:pedido.pedido-item-edit :$item />
        @endif
    </x-modal>
    <x-card>
        <x-table :headers="$headers" :rows="$itensPedido" @row-click="$wire.edit($event.detail.id)">
            @scope('cell_valor_unitario', $item)
            {{ number_format($item->valor_unitario, 2, ',', '.') }}
            @endscope

            @scope('cell_valor_total', $item)
            {{ number_format($item->valor_total, 2, ',', '.') }}
            @endscope

            @if($pedido->status_pedido_id == 1)
            @scope('actions', $item)
            <x-button icon="o-trash" wire:click="delete({{ $item->id }})" class="text-red-500 btn-sm" />
            @endscope
            @endif

        </x-table>
    </x-card>
</div>