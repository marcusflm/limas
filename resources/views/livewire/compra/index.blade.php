<div>
    <x-header title="Compras" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Novo compra">
        <livewire:compra.compra-create />
    </x-modal>

    @if($compras->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$compras" striped @row-click="$wire.navegar('/compras/' + $event.detail.id)">
            @scope('cell_data_compra', $compra)
            {{ $compra->data_compra->format('d/m/Y') }}
            @endscope

            @scope('cell_valor_total', $compra)
            {{ number_format($compra->valor_total, 2, ',', '.') }}
            @endscope


        </x-table>
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-user" title="Não foram encontrados compras" />
    </x-card>
    @endif
</div>