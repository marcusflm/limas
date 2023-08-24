<div>
    <div>
        <x-header title="Pedido {{$pedido->id}}" subtitle="Cliente: {{$pedido->cliente->nome}}" separator>
            <x-slot:actions>
                @if($itensPedido->count()>0 && $pedido->status_pedido_id == 1)
                <x-button wire:click="alterar_status_pedido" label="{{ $pedido->status_pedido_id == 1 ? 'Fechar pedido' : 'Pedido fechado' }}" icon="{{ $pedido->status_pedido_id == 1 ? 'o-lock-open' : 'o-lock-closed' }}" class="btn + {{ $pedido->status_pedido_id == 1 ? 'btn-outline btn-primary' : 'bg-primary text-white'}}" />
                @endif
                <x-button icon="o-plus" class="btn-primary" wire:click="cadastrar" />
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
        </x-card>
        <br>
        <div class="flex justify-end gap-3">
            <x-card>
                @if($pedido->status_pedido_id == 1)
                <x-input label=Desconto wire:model="valor_desconto" thousands-separator="." fraction-separator="," money />
                @else
                <x-input label=Desconto wire:model="valor_desconto" thousands-separator="." fraction-separator="," money readonly />
                @endif
            </x-card>
            <br>
            <x-card>
                <x-input label="Frete" wire:model="valor_frete" thousands-separator="." fraction-separator="," money readonly />
            </x-card>
            <br>
            <x-card>
                <x-input label="Total do pedido" wire:model="valor_total" thousands-separator="." fraction-separator="," money readonly />
            </x-card>

        </div>
        @else
        <x-card>
            <x-alert icon="o-user" title="Nenhum item encontrado" />
        </x-card>
        @endif
    </div>
</div>