<div class="flex justify-center">

    <div class="w-1/2">
        <x-card title="Novo cliente" shadow separator>
            <x-form wire:submit="save">
                <x-input label="Nome" wire:model="nome" required />
                <x-input label="Telefone" placeholder="(99) 9 9999-9999" x-mask="(99) 9 9999-9999" wire:model="telefone" required />
                <x-input label="E-mail" placeholder="email@email.com" wire:model="email" email required />
                <x-select label="Bairro" placeholder="Selecione um bairro" :options="$bairros" option-value="id" option-label="nome" wire:model="bairro_id" />
                <x-slot:actions>
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>

        </x-card>
    </div>

</div>