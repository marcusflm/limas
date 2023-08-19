<div class="flex justify-center">
    <div class="w-1/3">
        <x-card title="Novo produto" shadow separator>
            <x-form wire:submit="save">
                <x-input label="Nome" wire:model="nome" required />
                <x-input label="Valor" wire:model="valor" money required />
                <x-select label="Categoria" placeholder="Selecione uma categoria" :options="$categorias" option-value="id" option-label="nome" wire:model="categoria_id" />
                <x-input label="Descrição" wire:model="descricao" />
                <x-slot:actions>
                    <x-button label="Cadastrar" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>