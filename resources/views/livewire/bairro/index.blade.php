<div>
    <x-header title="Bairros" separator>
        <x-slot:actions>
            <x-input placeholder="Pesquisar..." wire:model.live="termo" icon="o-magnifying-glass" />
            <x-button icon="o-plus" class="btn-primary" @click="$wire.navegar('/bairros/create')" />
        </x-slot:actions>
    </x-header>
    @if($bairros->count()>0)
    <x-card>
        <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
        <x-livewire-alert::flash />
        <x-table :headers="$headers" :rows="$bairros" striped @row-click="$wire.navegar('/bairros/'+$event.detail.id)">
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