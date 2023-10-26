<x-form wire:submit="save">
    <x-input label="Nome" wire:model="nome" required />
    <x-input label="Telefone" wire:model="telefone" placeholder="(99) 9 9999-9999" x-mask="(99) 9 9999-9999" />
    <x-input label="E-mail" wire:model="email" placeholder="email@example.com" />
    <x-choices label="Bairro" wire:model="bairro_id" :options="$bairros" option-label="nome" icon="o-magnifying-glass" placeholder="Selecione.." single searchable />
    <x-slot:actions>
        <x-button label="Cancelar" wire:click="$dispatch('cliente-edicao-concluida')" />
        <x-button label="Salvar" class="btn-primary" type="submit" spinner="save" />
    </x-slot:actions>
</x-form>