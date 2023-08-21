<div>
    <x-header title="Pedidos" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" wire:click="cadastrar" />
        </x-slot:actions>
    </x-header>

    <x-table :headers="$headers" :rows="$pedidos">

        @scope('cell_data_pedido', $pedido)
        {{ $pedido->data_pedido->format('d/m/Y') }}
        @endscope

        @scope('cell_valor_total', $pedido)
        {{ number_format($pedido->valor_total, 2, ',', '.') }}
        @endscope

    </x-table>

    @if($pedidos->count() > 0)
    <x-card>

    </x-card>
    @else
    <x-alert icon="o-user" title="Sem pedidos" />
    @endif
</div>