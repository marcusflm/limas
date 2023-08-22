<div>
    <x-header title="Produtos" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar('/produtos/create')" />
        </x-slot:actions>
    </x-header>
    @if($produtos->count()>0)
    <x-card>
        <x-table :headers="$headers" :rows="$produtos" striped @row-click="$wire.navegar('/produtos/' + $event.detail.id)">
            @scope('cell_valor', $produto)
            {{ number_format($produto->valor, 2, ',', '.') }}
            @endscope
        </x-table>
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum produto encontrado" />
    @endif
</div>