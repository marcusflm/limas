<div>
    <x-header title="Bairros" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.create" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="{{ $bairro == null ? 'Novo bairro' : 'Editar bairro' }}" separator>
        @if($bairro)
        <livewire:bairro.bairro-edit :$bairro />
        @else
        <livewire:bairro.bairro-create />
        @endif
    </x-modal>
    @if($bairros->count()>0)
    <x-card>
        <x-table :headers="$headers" :rows="$bairros" striped @row-click="$wire.edit($event.detail.id)">
            @scope('cell_frete', $bairro)
            {{ number_format($bairro->frete, 2, ',', '.') }}
            @endscope
            @scope('actions', $bairro)
            <x-button icon="o-trash" wire:click="delete({{ $bairro->id }})" class="btn-sm btn-outline btn-error" />
            @endscope
        </x-table>
    </x-card>
    @else
    <x-alert icon="o-user" title="Nenhum bairro encontrado" />
    @endif
</div>