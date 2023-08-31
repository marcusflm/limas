<div>
    <x-header title="Compra {{$compra->id}}" subtitle="Mercado: {{$compra->mercado->nome}}" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>

    <x-modal wire:model="myModal" title="Novo item">
        <livewire:compra.compra-item-create :$compra />
    </x-modal>

    @if($compra->itensCompra()->count()>0)

    <x-card>
        <x-table :headers="$headers" :rows="$itensCompra" @row-click="$wire.edit($event.detail.id)">
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

    <div class="lg:flex justify-end gap-3">
        <x-card>
            <x-input label=Desconto wire:model="valor_desconto" thousands-separator="." fraction-separator="," money />
        </x-card>
        <br>
        <x-card>
            <x-input label="Frete" wire:model="valor_frete" thousands-separator="." fraction-separator="," money readonly />
        </x-card>
        <br>
        <x-card>
            <x-input label="Total itens" wire:model="valor_itens" thousands-separator="." fraction-separator="," money readonly />
        </x-card>
        <br>
        <x-card>
            <x-input label="Total do compra" wire:model="valor_total" thousands-separator="." fraction-separator="," money readonly />
        </x-card>
    </div>

    <br>

    <div>
        <x-card>
            <x-input label="Observação" wire:model="observacao" />
        </x-card>
    </div>
    @else
    <x-card>
        <x-alert icon="o-shopping-cart" title="Compra vazia!" />
    </x-card>
    @endif
</div>