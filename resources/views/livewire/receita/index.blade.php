<div>
    <x-header title="Receitas" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" @click="$wire.myModal = true" />
        </x-slot:actions>
    </x-header>
    <x-modal wire:model="myModal" title="Nova receita">
        <livewire:receita.receita-create />
    </x-modal>

    @if($receitas->count() > 0)
    <x-card>
        <x-table :headers="$headers" :rows="$receitas" striped @row-click="$wire.navegar('/receitas/' + $event.detail.id)" />
    </x-card>
    @else
    <x-card>
        <x-alert icon="o-book-open" title="Nenhuma receita encontrada!" />
    </x-card>
    @endif
</div>