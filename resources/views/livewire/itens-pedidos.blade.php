<div>
    <x-header title="Itens Pedido {{$pedido->id}}" subtitle="Cliente: {{$pedido->cliente->nome}}" separator>
        <x-slot:actions>
            <x-button icon="o-plus" class="btn-primary" wire:click="cadastrar({{$pedido->id}})" />
        </x-slot:actions>
    </x-header>

    <x-card>
        <x-table :headers="$headers" :rows="$itensPedido" striped @row-click="$wire.navegar($event.detail.id)" />
    </x-card>
</div>