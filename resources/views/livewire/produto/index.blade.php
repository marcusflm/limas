<div>
    <x-header title="Produtos" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Novo produto">
        <livewire:produto.produto-create />
    </x-modal>
    @if($produtos->count()>0)
    <x-card>
        <x-table :headers="$headers" :rows="$produtos" striped @row-click="$wire.navegar('/produtos/' + $event.detail.id )">
            @scope('cell_valor', $produto)
            {{ number_format($produto->valor, 2, ',', '.') }}
            @endscope
            @scope('actions', $produto)
            <x-button icon="o-trash" wire:click="delete({{ $produto->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum produto encontrado" />
    @endif
</div>