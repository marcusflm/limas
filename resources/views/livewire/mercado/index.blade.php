<div>
    <x-header title="Mercados" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot:actions>
    </x-header>

    <x-modal wire:model="myModal" :title="$mercado ? 'Editar mercado' : 'Novo mercado'">
        @if($mercado)
        <livewire:mercado.mercado-edit :$mercado />
        @else
        <livewire:mercado.mercado-create />
        @endif
    </x-modal>

    @if($mercados->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$mercados" striped @row-click="$wire.edit($event.detail.id)">
            @scope('actions', $mercado)
            <x-button icon="o-trash" wire:click="delete({{ $mercado->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-face-frown" title="Nenhum mercado encontrado" />
    </x-card>
    @endif
</div>