<div>
    <div class="h-full">
        <x-card>
            <x-header title="Bairros" separator>
                <x-slot:actions>
                    <x-button icon="o-plus" class="btn-primary" wire:click="cadastrar" />
                </x-slot:actions>
            </x-header>

            <x-table :headers="$headers" :rows="$bairros" striped @row-click="$wire.navegar($event.detail.id)" />
        </x-card>
    </div>
</div>