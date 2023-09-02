<div>
    <x-header title="Lotes" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Novo lote">
        <livewire:lote.lote-create />
    </x-modal>

    @if($lotes->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$lotes" striped @row-click="$wire.navegar('/lotes/' + $event.detail.id)">
            @scope('cell_custo_unitario', $lote)
            {{ number_format($lote->custo_unitario, 2, ',', '.') }}
            @endscope

            @scope('cell_custo_lote', $lote)
            {{ number_format($lote->custo_lote, 2, ',', '.') }}
            @endscope

        </x-table>
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-tag" title="Nenhum lote encontrado!" />
    </x-card>
    @endif
</div>