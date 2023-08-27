<div>
    <x-form wire:submit="save" class="p-5">
        <x-input label="Nome" :value="$nome" readonly />
        <x-input label="Categoria" :value="$produto->categoria->nome" readonly />
        <div class="w-1/2 lg:w-2/5">
            <x-input label="Valor" wire:model="valor" prefix="R$" thousands-separator="." fraction-separator="," money required />
        </div>
        <x-input label="Descrição" wire:model="descricao" />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="$parent.myModal = false" />
            <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>