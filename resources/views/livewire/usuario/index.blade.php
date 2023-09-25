<div>
    <x-header title="Usuários" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot>
    </x-header>

    <x-modal wire:model="myModal" title="Novo usuário">
        <livewire:usuario.usuario-create />
    </x-modal>

    @if ($usuarios->count() > 0)
        <x-card>
            <x-table :headers="$headers" :rows="$usuarios" striped @row-click="$wire.navegar('/usuarios/' + $event.detail.id)">
                @scope('actions', $usuario)
                    <x-button icon="o-trash" wire:click="delete({{ $usuario->id }})" class="btn-error btn-outline btn-sm" />
                @endscope
            </x-table>
        </x-card>
    @else
        <x-card>
            <x-alert icon="o-face-frown" title="Nenhum usuário encontrado" />
        </x-card>
    @endif
</div>
