<div>
    <x-header title="Categorias" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot:actions>
    </x-header>

    <x-modal wire:model="myModal" :title="$categoria ? 'Editar categoria' : 'Nova categoria'">
        @if($categoria)
        <livewire:categoria.categoria-edit :$categoria />
        @else
        <livewire:categoria.categoria-create />
        @endif
    </x-modal>

    @if($categorias->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$categorias" striped @row-click="$wire.edit($event.detail.id)">
            @scope('actions', $categoria)
            <x-button icon="o-trash" wire:click="delete({{ $categoria->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-face-frown" title="Nenhuma categoria encontrada" />
    </x-card>
    @endif
</div>