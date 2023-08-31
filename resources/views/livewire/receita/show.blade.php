<div>
    <x-header title="Receita lote de {{$receita->produto->nome}}" subtitle="Lote de 15 unidades" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>

    <x-modal wire:model="myModal" title="Novo item">
        <livewire:receita.receita-item-create :$receita />
    </x-modal>

    @if($receita->ingredientesReceita()->count()>0)

    <x-card>
        <x-table :headers="$headers" :rows="$ingredientesReceita" @row-click="$wire.edit($event.detail.id)">
            @scope('cell_quantidade', $ingrediente)
            {{ number_format($ingrediente->quantidade, 2, ',', '.') }}
            @endscope

            @scope('actions', $ingrediente)
            <x-button icon="o-trash" wire:click="delete({{ $ingrediente->id }})" class="text-red-500 btn-sm" />
            @endscope
        </x-table>
    </x-card>

    <br>

    <div>
        <x-card>
            <x-input label="Observação" wire:model="observacao" />
        </x-card>
    </div>
    @else
    <x-card>
        <x-alert icon="o-shopping-cart" title="Receita vazia!" />
    </x-card>
    @endif
</div>