<div>
    <x-header title="Categorias" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="{{ $categoria == null ? 'Novo categoria' : 'Editar categoria' }}">
        @if($categoria)
        <livewire:categoria.categoria-edit :$categoria />
        @else
        <livewire:categoria.categoria-create />
        @endif
    </x-modal>
    <x-card>

        <x-table :headers="$headers" :rows="$categorias" striped @row-click="$wire.edit($event.detail.id)">
            @scope('actions', $categoria)
            <x-button icon="o-trash" wire:click="delete({{ $categoria->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
</div>