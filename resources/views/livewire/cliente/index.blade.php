<div>
    <x-header title="Clientes" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Novo cliente">
        <livewire:cliente.cliente-create />
    </x-modal>
    @if($clientes->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$clientes" striped @row-click="$wire.navegar('/clientes/' + $event.detail.id)">
            @scope('cell_telefone', $cliente)
            {{ $this->formataTelefone($cliente->telefone) }}
            @endscope

            @scope('actions', $cliente)
            <x-button icon="o-trash" wire:click="delete({{ $cliente->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum cliente encontrado" />
    @endif
</div>