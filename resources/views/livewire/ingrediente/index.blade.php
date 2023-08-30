<div>
    <x-header title="Ingredientes" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot:actions>
    </x-header>

    <x-modal wire:model="myModal" :title="$ingrediente ? 'Editar ingrediente' : 'Novo ingrediente'">
        @if($ingrediente)
        <livewire:ingrediente.ingrediente-edit :$ingrediente />
        @else
        <livewire:ingrediente.ingrediente-create />
        @endif
    </x-modal>

    @if($ingredientes->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$ingredientes" striped @row-click="$wire.edit($event.detail.id)">
            @scope('actions', $ingrediente)
            <x-button icon="o-trash" wire:click="delete({{ $ingrediente->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-face-frown" title="Nenhum ingrediente encontrado" />
    </x-card>
    @endif
</div>