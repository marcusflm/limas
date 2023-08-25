<div>
    <x-form wire:submit="save">
        <x-input label="Nome" wire:model="nome" required />
        <x-input label="Telefone" wire:model="telefone" placeholder="(99) 9 9999-9999" x-mask="(99) 9 9999-9999" required />
        <x-input label="E-mail" wire:model="email" placeholder="email@example.com" required />
        <x-select label="Bairro" wire:model="bairro_id" placeholder="Selecione um bairro" :options="$bairros" option-value="id" option-label="nome" />
        <x-slot:actions>
            <x-button label="Cancelar" wire:click="$parent.myModal = false" />
            <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>