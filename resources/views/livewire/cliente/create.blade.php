<div>
    <x-header title="Novo cliente" separator />
    <div class="w-1/2 mx-auto">
        <x-card shadow>
            <x-form wire:submit="save">
                <x-input label="Nome" wire:model="cliente.nome" required />
                <x-input label="Telefone" wire:model="cliente.telefone" placeholder="(99) 9 9999-9999" x-mask="(99) 9 9999-9999" maxlength="11" required />
                <x-input label="E-mail" wire:model="cliente.email" placeholder="email@example.com" required />
                <x-select label="Bairro" wire:model="cliente.bairro_id" placeholder="Selecione um bairro" :options="$bairros" option-value="id" option-label="nome" />
                <x-slot:actions>
                    <x-button label="Cancelar" @click="$wire.navegar('/clientes')" />
                    <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>