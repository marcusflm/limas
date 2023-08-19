<div>
    <x-card>
        <x-header title="Pedidos" separator>
            <x-slot:actions>
                <x-button icon="o-plus" class="btn-primary" wire:click="cadastrar" />
            </x-slot:actions>
        </x-header>

        <x-table :headers="$headers" :rows="$pedidos" striped @row-click="$wire.navegar($event.detail.id)" />
    </x-card>
</div>