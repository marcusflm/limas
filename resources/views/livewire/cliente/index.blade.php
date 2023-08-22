<div>
    <x-header title="Clientes" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar('/clientes/create')" />
        </x-slot:actions>
    </x-header>
    @if($clientes->count()>0)
    <x-card>
        <x-table :headers="$headers" :rows="$clientes" striped @row-click="$wire.navegar('/clientes/'+$event.detail.id)" />
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum cliente encontrado" />
    @endif
</div>