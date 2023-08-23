<div>
    <x-header title="Clientes" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar('/clientes/create')" />
        </x-slot:actions>
    </x-header>
    @if($clientes->count()>0)
    <x-card>
        <x-table :headers="$headers" :rows="$clientes" striped @row-click="$wire.navegar('/clientes/' + $event.detail.id)">
            @scope('actions', $cliente)
            <x-button icon="o-trash" wire:click="delete({{ $cliente->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum cliente encontrado" />
    @endif
</div>