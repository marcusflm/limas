<div>
    <div class="h-full">
        <x-card>
            <x-header title="Clientes" separator>
                <x-slot:actions>
                    <x-button icon="o-plus" class="btn-primary" wire:click="cadastrar" />
                </x-slot:actions>
            </x-header>

            <x-table :headers="$headers" :rows="$clientes" striped />
        </x-card>
    </div>
</div>