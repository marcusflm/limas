<div>
    <x-header title="Pedidos" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" wire:click="cadastrar" />
        </x-slot:actions>
    </x-header>

    @if($pedidos->count())
    <x-card>
        <x-table :headers="$headers" :rows="$pedidos" striped @row-click="$wire.navegar('/itens-pedido/' + $event.detail.id)" />
    </x-card>
    @else
    <x-alert icon="o-user" title="Sem pedidos" />
    @endif
</div>