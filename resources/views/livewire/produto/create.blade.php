<div>
    <x-form wire:submit="save">
        <x-input label="Nome" wire:model.blur="nome" required />
        <x-select label="Categoria" placeholder="Selecione uma categoria" :options="$categorias" option-value="id" option-label="nome" wire:model="categoria_id" />
        <div class="w-1/2 lg:w-2/5 end-0">
            <x-input label="Valor" wire:model="valor" prefix="R$" thousands-separator="." fraction-separator="," money required />
        </div>
        <x-input label="Descrição" wire:model="descricao" />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="$parent.myModal = false" />
            <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>