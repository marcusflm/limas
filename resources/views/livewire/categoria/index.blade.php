<div>
    <x-header title="Categorias" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar('/categorias/create')" />
        </x-slot:actions>
    </x-header>
    <x-card>

        <x-table :headers="$headers" :rows="$categorias" striped @row-click="$wire.navegar('/categorias/' + $event.detail.id)">
            @scope('actions', $categoria)
            <x-button icon="o-trash" wire:click="delete({{ $categoria->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
</div>