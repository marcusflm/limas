<div>
    <x-header title="Nova categoria" separator />
    <div class="mx-auto lg:w-1/2 md:w-3/5">
        <x-card shadow>
            <x-form wire:submit="save">
                <x-input label="Nome" wire:model="nome" required />
                <x-slot:actions>
                    <x-button label="Cancelar" @click="$wire.navegar('/categorias')" />
                    <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>