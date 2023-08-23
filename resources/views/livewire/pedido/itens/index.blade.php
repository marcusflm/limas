<div>
    <x-header title="Itens Pedido {{$pedido->id}}" subtitle="Cliente: {{$pedido->cliente->nome}}" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar({{$pedido->status_pedido_id}} == 1 ?? '/pedidos/' + {{$pedido->id}} + '/itens/create')" />
        </x-slot:actions>
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
        <br>
        <div class="flex justify-end">
            <x-input label=Desconto wire:model="valor_desconto" thousands-separator="." fraction-separator="," />
        </div>
        <br>
        <div class="flex justify-end">
            <x-input label="Frete" wire:model.live="valor_frete" thousands-separator="." fraction-separator="," readonly />
        </div>
        <br>
        <div class="flex justify-end">
            <x-input label="Total do pedido" wire:model.live="valor_total" thousands-separator="." fraction-separator="," readonly />
        </div>
        <br>
        <div class="flex justify-end">
            <x-button label="{{ $pedido->status_pedido_id == 1 ? 'Fechar pedido' : 'Pedido fechado' }}" icon="{{ $pedido->status_pedido_id == 1 ? 'o-lock-open' : 'o-lock-closed' }}" wire:click="alterar_status_pedido" class="btn + {{ $pedido->status_pedido_id == 1 ? 'btn-outline btn-primary' : 'bg-primary text-white'}}" />
        </div>
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum item encontrado" />
    @endif
</div>