<div>
    <x-header title="Novo cliente" separator />
    <div class="mx-auto lg:w-1/2 md:w-3/5">
        <x-card shadow>
            <x-form wire:submit="save">
                <x-input label="Nome" wire:model="nome" required />
                <x-input label="Telefone" wire:model="telefone" placeholder="(99) 9 9999-9999" x-mask="(99) 9 9999-9999" required />
                <x-input label="E-mail" wire:model="email" placeholder="email@example.com" required />
                <x-select label="Bairro" wire:model="bairro_id" placeholder="Selecione um bairro" :options="$bairros" option-value="id" option-label="nome" />
                <x-slot:actions>
                    <x-button label="Cancelar" @click="$wire.navegar('/clientes')" />
                    <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>